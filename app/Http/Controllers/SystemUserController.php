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
        $users = User::all();

        /*
        |--------------------------------------------------------------------------
        | Patient appointments eligible for creating a patient account
        |-  -------------------------------------------------------------------------
        |
        | 1. Appointment must NOT already have user_id.
        | 2. Appointment must have phone or email.
        | 3. There must NOT already be a User with the same phone/email.
        | 4. Both doctor and service appointments are included.
        |
        */

        $patientAppointments = Appointment::query()
            ->with([
                'doctor',
                'service',
            ])
            ->whereNull('user_id')
            ->where(function ($query) {

                $query->whereNotNull('phone')
                    ->orWhereNotNull('email');
            })
            ->get()
            ->filter(function ($appointment) {

                $userQuery = User::query();

                /* Check existing account by phone OR email */
                if ($appointment->phone && $appointment->email) {

                    $userQuery->where(function ($query) use ($appointment) {

                        $query->where('phone', $appointment->phone)
                            ->orWhere('email', $appointment->email);
                    });
                } elseif ($appointment->phone) {

                    $userQuery->where(
                        'phone',
                        $appointment->phone
                    );
                } elseif ($appointment->email) {

                    $userQuery->where(
                        'email',
                        $appointment->email
                    );
                }

                /* Only return appointments where no account exists */
                return !$userQuery->exists();
            })
            ->sort(function ($a, $b) {

                /* Appointment date latest first */
                $dateCompare = strcmp(
                    $b->appointment_date ?? '',
                    $a->appointment_date ?? ''
                );

                if ($dateCompare !== 0) {
                    return $dateCompare;
                }

                /* Same date: appointment time latest first */
                $timeCompare = strcmp(
                    $b->appointment_time ?? '',
                    $a->appointment_time ?? ''
                );

                if ($timeCompare !== 0) {
                    return $timeCompare;
                }

                /* Same date and time: patient name A-Z */
                return strcasecmp(
                    $a->name ?? '',
                    $b->name ?? ''
                );
            })
            ->values();

        return view(
            'backend.setting_management.user_management.system_user.index',
            compact(
                'users',
                'patientAppointments'
            )
        );
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
            $user = User::where(
                'phone',
                $request->phone
            )->first();
        }

        /*If phone did not find anything, try email  */
        if (!$user && $request->filled('email')) {
            $user = User::where(
                'email',
                $request->email
            )->first();
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
                    'appointment_id' =>
                    'This patient already has an account.',
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
            $appointment->update([
                'user_id' => $user->id,
            ]);
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
