<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{
    /**
     * Display all doctors
     */
    public function index()
    {
        /*
    |--------------------------------------------------------------------------
    | ADMIN CAN SEE ALL DOCTORS
    |--------------------------------------------------------------------------
    */

        if (auth()->user()->hasRole('admin')) {

            $doctors = Doctor::latest()->get();
        }

        /*
    |--------------------------------------------------------------------------
    | DOCTOR CAN SEE ONLY OWN PROFILE
    |--------------------------------------------------------------------------
    */ elseif (auth()->user()->hasRole('doctor')) {

            $doctors = Doctor::where(
                'user_id',
                auth()->id()
            )->latest()->get();
        }

        /*
    |--------------------------------------------------------------------------
    | OTHER USERS
    |--------------------------------------------------------------------------
    */ else {

            $doctors = collect();
        }

        return view(
            'backend.doctor_section.index',
            compact('doctors')
        );
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view(
            'backend.doctor_section.create'
        );
    }

    /**
     * Store new doctor
     */
    public function store(Request $request)
    {
        $request->validate([

            'name'               => 'required|string|max:255',

            'username'           => 'required|string|max:255|unique:users,username',

            'email'              => 'required|email|unique:users,email',

            'password'           => 'nullable|string|min:6',

            'speciality'         => 'required|string|max:255',

            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'success_rate'       => 'nullable|numeric',

            'experience_years'   => 'nullable|numeric',

            'total_patients'     => 'nullable|string',

            'qualification'      => 'nullable|string|max:255',

            'location'           => 'nullable|string|max:255',

            'consultation_fee'   => 'nullable|numeric',

            'availability'       => 'nullable|string|max:255',

            'about'              => 'nullable|string',

        ]);

        /*
    |--------------------------------------------------------------------------
    | CREATE DOCTOR FIRST
    |--------------------------------------------------------------------------
    */

        $doctor = new Doctor();

        $doctor->name               = $request->name;

        $doctor->speciality         = $request->speciality;

        $doctor->success_rate       = $request->success_rate;

        $doctor->experience_years   = $request->experience_years;

        $doctor->total_patients     = $request->total_patients;

        $doctor->qualification      = $request->qualification;

        $doctor->location           = $request->location;

        $doctor->consultation_fee   = $request->consultation_fee;

        $doctor->availability       = $request->availability;

        $doctor->about              = $request->about;

        /*
    |--------------------------------------------------------------------------
    | IMAGE UPLOAD
    |--------------------------------------------------------------------------
    */

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $destinationPath = public_path('uploads/images/doctor');

            if (!File::exists($destinationPath)) {

                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $imageName = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->move($destinationPath, $imageName);

            $doctor->image = 'uploads/images/doctor/' . $imageName;
        }

        /*
    |--------------------------------------------------------------------------
    | SAVE DOCTOR
    |--------------------------------------------------------------------------
    */

        $doctor->save();

        /*
|--------------------------------------------------------------------------
| CREATE USER ACCOUNT
|--------------------------------------------------------------------------
*/

        $user = User::create([

            'name'      => $request->name,

            'username'  => $request->username,

            'email'     => $request->email,

            'password'  => Hash::make(
                $request->password ?? 'Admin123'
            ),

        ]);

        /*
|--------------------------------------------------------------------------
| ASSIGN SPATIE ROLE
|--------------------------------------------------------------------------
*/

        $user->assignRole('doctor');
        /*
    |--------------------------------------------------------------------------
    | UPDATE DOCTOR USER ID
    |--------------------------------------------------------------------------
    */

        $doctor->user_id = $user->id;

        $doctor->save();

        /*
    |--------------------------------------------------------------------------
    | REDIRECT
    |--------------------------------------------------------------------------
    */

        return redirect()
            ->route('doctors.index')
            ->with(
                'success',
                'Doctor Added Successfully. Login Password: ' .
                    ($request->password ?? 'Admin123')
            );
    }
    /**
     * Show doctor details
     */
    public function show($id)
    {
        /*
    |--------------------------------------------------------------------------
    | ADMIN CAN VIEW ANY DOCTOR
    |--------------------------------------------------------------------------
    */

        if (auth()->user()->hasRole('admin')) {

            $doctor = Doctor::findOrFail($id);
        }

        /*
    |--------------------------------------------------------------------------
    | DOCTOR CAN VIEW ONLY OWN PROFILE
    |--------------------------------------------------------------------------
    */ elseif (auth()->user()->hasRole('doctor')) {

            $doctor = Doctor::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
        }

        /*
    |--------------------------------------------------------------------------
    | OTHER USERS
    |--------------------------------------------------------------------------
    */ else {

            abort(403, 'Unauthorized Access');
        }

        return view(
            'backend.doctor_section.show',
            compact('doctor')
        );
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);

        return view(
            'backend.doctor_section.edit',
            compact('doctor')
        );
    }

    /**
     * Update doctor
     */
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $user = User::find($doctor->user_id);
        // Form Validation 
        $request->validate([
            'name'               => 'required|string|max:255',
            'username'           => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'              => 'required|email|unique:users,email,' . $user->id,
            'password'           => 'nullable|string|min:6',
            'speciality'         => 'required|string|max:255',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'success_rate'       => 'nullable|numeric',
            'experience_years'   => 'nullable|string|max:255',
            'total_patients'     => 'nullable|string|max:255',
            'qualification'      => 'nullable|string|max:255',
            'location'           => 'nullable|string|max:255',
            'consultation_fee'   => 'nullable|numeric',
            'availability'       => 'nullable|string|max:255',
            'about'              => 'nullable|string',
        ]);

        $doctor->name               = $request->name;
        $doctor->speciality         = $request->speciality;
        $doctor->success_rate       = $request->success_rate;
        $doctor->experience_years   = $request->experience_years;
        $doctor->total_patients     = $request->total_patients;
        $doctor->qualification      = $request->qualification;
        $doctor->location           = $request->location;
        $doctor->consultation_fee   = $request->consultation_fee;
        $doctor->availability       = $request->availability;
        $doctor->about              = $request->about;

        /*
    |--------------------------------------------------------------------------
    | UPDATE IMAGE
    |--------------------------------------------------------------------------
    */

        if ($request->hasFile('image')) {
            /*Delete Old Image */
            if (
                $doctor->image &&
                File::exists(public_path($doctor->image))
            ) {
                File::delete(public_path($doctor->image));
            }

            /*Create Directory */
            $destinationPath = public_path('uploads/images/doctor');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            /*Upload Image */
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->move($destinationPath, $imageName);
            $doctor->image = 'uploads/images/doctor/' . $imageName;
        }

        $doctor->save();
        //Update User Account Information
        if ($user) {
            $user->name       = $request->name;
            $user->username   = $request->username;
            $user->email      = $request->email;

            /*Update Password If Provided */
            if ($request->filled('password')) {

                $user->password = Hash::make($request->password);
            }
            $user->save();
            /* Sync Spatie Role */
            $user->syncRoles(['doctor']);
        }

        return redirect()
            ->route('doctors.index')
            ->with(
                'success',
                'Doctor Updated Successfully'
            );
    }
    /**
     * Delete doctor
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $user = User::find($doctor->user_id);

        /*Delete Image*/
        if (
            $doctor->image &&
            File::exists(public_path($doctor->image))
        ) {

            File::delete(public_path($doctor->image));
        }
        
        $doctor->delete();

        /*Delete Related User*/
        if ($user) {
            $user->delete();
        }

        return redirect()
            ->route('doctors.index')
            ->with(
                'success',
                'Doctor and User Deleted Successfully'
            );
    }
}
