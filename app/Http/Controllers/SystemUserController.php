<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SystemUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        /* Users: oldest → latest */
        /* System Users */
        $users = User::query()
            ->with(['roles', 'doctor'])
            ->oldest('created_at')
            ->get()
            ->each(function ($user) {
                $user->profile_image =
                    $user->hasRole('doctor') &&
                    $user->doctor &&
                    $user->doctor->image
                    ? asset($user->doctor->image)
                    : (
                        $user->profile_picture
                        ? asset($user->profile_picture)
                        : asset('uploads/images/default.jpg')
                    );
            });

        /* Patient appointments eligible for creating a patient account */
        $patientAppointments = Appointment::query()
            ->with(['doctor', 'service'])
            ->whereNull('user_id')
            ->where(function ($query) {
                $query->whereNotNull('phone')
                    ->orWhereNotNull('email');
            })
            ->get()
            ->filter(function ($appointment) {
                $userQuery = User::query();

                if ($appointment->phone && $appointment->email) {
                    $userQuery->where(function ($query) use ($appointment) {
                        $query->where('phone', $appointment->phone)
                            ->orWhere('email', $appointment->email);
                    });
                } elseif ($appointment->phone) {
                    $userQuery->where('phone', $appointment->phone);
                } elseif ($appointment->email) {
                    $userQuery->where('email', $appointment->email);
                }

                return !$userQuery->exists();
            })
            ->sort(function ($a, $b) {
                /* Oldest appointment first */
                $dateCompare = strcmp(
                    $a->appointment_date?->format('Y-m-d') ?? '',
                    $b->appointment_date?->format('Y-m-d') ?? ''
                );

                if ($dateCompare !== 0) {
                    return $dateCompare;
                }

                /* Earliest time first */
                $timeCompare = strcmp(
                    $a->appointment_time?->format('H:i:s') ?? '',
                    $b->appointment_time?->format('H:i:s') ?? ''
                );

                if ($timeCompare !== 0) {
                    return $timeCompare;
                }

                /* Alphabetical name fallback */
                return strcasecmp(
                    $a->name ?? '',
                    $b->name ?? ''
                );
            })
            ->values();

        /* Group patient appointments by date */
        $patientAppointmentGroups = $patientAppointments
            ->groupBy(function ($appointment) {
                return $appointment->appointment_date->format('Y-m-d');
            })
            ->map(function ($appointments) {
                return [
                    'date' => $appointments->first()->appointment_date,
                    'appointments' => $appointments->values(),
                ];
            })
            ->values();

        /* System User Statistics */
        $userTotals = [
            'admin' => User::role('admin')->count(),
            'doctor' => User::role('doctor')->count(),
            'patient_created' => User::role('user')->count(),
            'patient_not_created' => $patientAppointments->count(),
        ];

        return view(
            'backend.setting_management.user_management.system_user.index',
            compact(
                'patientAppointments',
                'patientAppointmentGroups',
                'userTotals',
                'users'
            )
        );
    }

    public function user_data(Request $request)
    {
        $query = User::query()
            ->with(['roles', 'doctor']);

        /* Role Filter */
        if ($request->filled('role')) {
            $query->whereHas('roles', function ($roleQuery) use ($request) {
                $roleQuery->where('name', $request->role);
            });
        }

        /* Search Filter */
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($searchQuery) use ($search) {
                $searchQuery->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('phone_2', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        /* DataTables */
        $draw = (int) $request->input('draw', 1);
        $start = (int) $request->input('start', 0);
        $length = (int) $request->input('length', 10);

        $totalRecords = User::count();

        $filteredRecords = (clone $query)->count();

        $users = $query
            ->latest('id')
            ->skip($start)
            ->take($length)
            ->get();

        $data = $users->map(function ($user, $index) use ($start) {
            /* Profile Image */
            if (
                $user->hasRole('doctor') &&
                $user->doctor &&
                $user->doctor->image
            ) {
                $image = asset($user->doctor->image);
            } elseif ($user->profile_picture) {
                $image = asset($user->profile_picture);
            } else {
                $image = asset('uploads/images/default.jpg');
            }

            /* Roles */
            $roles = $user->roles
                ->pluck('name')
                ->map(function ($role) {
                    return '<span class="system-user-role-badge">'
                        . e(ucfirst($role))
                        . '</span>';
                })
                ->implode(' ');

            /* Actions */
            $viewUrl = route('system_users.show', $user->id);
            $editUrl = route('system_users.edit', $user->id);
            $deleteUrl = route('system_users.destroy', $user->id);

            $roleName = $user->roles
                ->pluck('name')
                ->join(', ');

            $actions = '
            <div class="system-user-actions">
                <a href="' . $viewUrl . '" class="btn btn-info btn-sm">
                    <i class="fas fa-eye mr-1"></i>
                    View
                </a>
                <a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit mr-1"></i>
                    Edit
                </a>
        ';

            if (auth()->user()->hasRole('admin')) {
                $actions .= '
                <button type="button"
                        class="btn btn-danger btn-sm change-password-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#changePasswordModal"
                        data-user-id="' . $user->id . '"
                        data-user-name="' . e($user->name) . '"
                        data-user-email="' . e($user->email ?? '') . '"
                        data-user-role="' . e($roleName) . '"
                        data-user-picture="' . e($image) . '">
                    <i class="fas fa-key mr-1"></i>
                    Change Password
                </button>
                <form action="' . $deleteUrl . '"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm(\'Are you sure you want to delete this user?\');">
                    ' . csrf_field() . '
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-secondary btn-sm">
                        <i class="fas fa-trash mr-1"></i>
                        Delete
                    </button>
                </form>
            ';
            }

            $actions .= '</div>';

            /* User Image */
            $userHtml = '
            <div class="system-user-profile">
                <div class="system-user-avatar">
                    <img src="' . e($image) . '"
                         alt="' . e($user->name) . '"
                         loading="lazy">
                </div>
                <div class="system-user-name">
                    ' . e($user->name) . '
                </div>
            </div>
        ';

            return [
                /*
             * DataTables server-side equivalent of $loop->iteration
             */
                'number' => $start + $index + 1,

                'role' => $roles,

                'name' => $userHtml,

                'email' => $user->email
                    ? e($user->email)
                    : '<span class="text-muted">Not Provided</span>',

                'phone' => $user->phone
                    ? e($user->phone)
                    : '<span class="text-muted">Not Provided</span>',

                'phone_2' => $user->phone_2
                    ? e($user->phone_2)
                    : '<span class="text-muted">Not Provided</span>',

                'username' => $user->username
                    ? e($user->username)
                    : '<span class="text-muted">Not Provided</span>',

                'actions' => $actions,
            ];
        });

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.setting_management.user_management.system_user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'phone_2' => 'nullable|string|max:15',
            'role' => 'required|string|exists:roles,name',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone_2' => $request->phone_2,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()
            ->route('system_users.index')
            ->with('success', 'User created successfully.');
    }

    public function patient_user_find(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $user = null;

        /*First try phone*/
        if ($request->filled('phone')) {
            $user = User::where('phone', $request->phone)->first();
        }

        /*If phone did not find anything, try email  */
        if (!$user && $request->filled('email')) {
            $user = User::where('email', $request->email)->first();
        }

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'No existing user found.',
            ]);
        }

        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
            ],
        ]);
    }

    public function patient_user_find_by_id($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ]);
        }

        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
            ],
        ]);
    }

    public function patient_user_store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => ['required', 'exists:appointments,id',],
            'email' => ['nullable', 'email', 'max:255',],
            'password' => ['required', 'string', 'min:8', 'confirmed',],
        ], [
            'appointment_id.required' => 'Please select a patient appointment.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter a new password.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);


        DB::transaction(function () use ($validated) {
            $appointment = Appointment::lockForUpdate()
                ->findOrFail($validated['appointment_id']);

            /* Appointment already has an account  */
            if ($appointment->user_id) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'appointment_id' =>
                    'This patient already has an account.',
                ]);
            }

            /* Determine email - If admin entered an email, use it. Otherwise use appointment email.*/
            $email = !empty($validated['email']) ? $validated['email'] : $appointment->email;

            /* Check existing user by phone */
            $existingUser = null;
            if ($appointment->phone) {
                $existingUser = User::where('phone', $appointment->phone)->first();
            }

            /* Check existing user by email */
            if (!$existingUser && $email) {
                $existingUser = User::where('email', $email)->first();
            }

            /*Prevent duplicate patient account   */
            if ($existingUser) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'appointment_id' => 'This patient already has an account.',
                ]);
            }
            /* Generate unique username*/
            $baseUsername = Str::slug($appointment->name);

            if (!$baseUsername) {
                $baseUsername = 'patient';
            }

            $username = $baseUsername;
            $counter = 1;

            while (
                User::where('username', $username)->exists()
            ) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            /* Create patient user*/
            $user = User::create([
                'name' => $appointment->name,
                'email' => $email,
                'username' => $username,
                'password' => Hash::make($validated['password']),
                'phone' => $appointment->phone,
                'phone_2' => null,
                'profile_picture' => null,
            ]);

            /*Assign patient role */
            $user->assignRole('user');

            /* Link appointment with new patient account */
            $appointment->update(['user_id' => $user->id,]);
        });

        return redirect()
            ->route('system_users.index')
            ->with(
                'success',
                'Patient user account created successfully.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('backend.setting_management.user_management.system_user.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.setting_management.user_management.system_user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'phone_2' => 'nullable|string|max:15',
            'role' => 'required|string|exists:roles,name', // Ensure the role exists
        ]);

        // Update user data
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone_2' => $request->phone_2 ?? null,
        ]);

        // Update the user's role
        $role = Role::where('name', $request->role)->first();
        $user->roles()->sync([$role->id]);

        return redirect()->route('system_users.index')
            ->with('success', 'User updated successfully updated!');
    }

    public function editPassword(User $user)
    {
        // Optional extra safety
        abort_unless(auth()->user()->hasRole('admin'), 403);
        return view('backend.system_users.change_password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('system_users.index')->with('success', 'User deleted successfully!');
    }
}
