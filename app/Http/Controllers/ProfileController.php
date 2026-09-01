<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function user_profile_show()
    {
        $user = Auth::user();

        $doctor = null;

        if ($user->hasRole('doctor')) {
            $doctor = Doctor::where('user_id', $user->id)->first();
        }

        if ($user->hasRole('admin')) {
            $roleName = 'Administrator';
            $roleIcon = 'fas fa-user-shield';
            $roleClass = 'profile-role-admin';
            $roleMessageClass = 'profile-message-admin';
            $roleMessageTitle = 'Administrator Account';
            $roleMessage = 'You have administrative access to manage the system, users, appointments and other platform resources.';
            $roleHeader = 'System Administrator';
        } elseif ($user->hasRole('doctor')) {
            $roleName = 'Doctor';
            $roleIcon = 'fas fa-user-md';
            $roleClass = 'profile-role-doctor';
            $roleMessageClass = 'profile-message-doctor';
            $roleMessageTitle = 'Doctor Account';
            $roleMessage = 'Your profile contains your professional information and doctor-specific details used throughout the system.';
            $roleHeader = 'Medical Professional';
        } elseif ($user->hasRole('user')) {
            $roleName = 'User';
            $roleIcon = 'fas fa-user';
            $roleClass = 'profile-role-user';
            $roleMessageClass = 'profile-message-user';
            $roleMessageTitle = 'User Account';
            $roleMessage = 'Keep your contact and account information up to date so your appointments and communications remain accurate.';
            $roleHeader = 'Personal Account';
        } else {
            $roleName = 'No Role Assigned';
            $roleIcon = 'fas fa-user-question';
            $roleClass = 'profile-role-default';
            $roleMessageClass = 'profile-message-default';
            $roleMessageTitle = 'Unassigned Account';
            $roleMessage = 'Your account does not currently have a recognized system role. Please contact an administrator if you believe a role should be assigned to your account.';
            $roleHeader = 'Account Profile';
        }

        return view(
            'backend.setting_management.user_management.profile.show',
            compact(
                'user',
                'doctor',
                'roleName',
                'roleIcon',
                'roleClass',
                'roleMessageClass',
                'roleMessageTitle',
                'roleMessage',
                'roleHeader'
            )
        );
    }
    public function user_profile_edit()
    {
        $user = Auth::user();

        return view(
            'backend.setting_management.user_management.profile.edit',
            compact('user')
        );
    }

    public function user_profile_update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'phone_2' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6',
            'confirm_password' => 'nullable|string|same:new_password',
        ]);

        $user->fill(
            $request->only([
                'name',
                'username',
                'email',
                'phone',
                'phone_2'
            ])
        )->save();

        /*
        |--------------------------------------------------------------------------
        | PASSWORD
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('current_password') ||
            $request->filled('new_password') ||
            $request->filled('confirm_password')
        ) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()
                    ->withErrors([
                        'current_password' => 'Current password is incorrect.'
                    ])
                    ->withInput();
            }

            if ($request->new_password && $request->confirm_password) {
                $user->password = bcrypt($request->new_password);
                $user->save();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | PROFILE PICTURE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('profile_picture')) {

            $image = $request->file('profile_picture');

            $filename =
                time() .
                '_' .
                uniqid() .
                '.' .
                $image->getClientOriginalExtension();

            $destination = public_path('images/profile_pictures');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            if (
                $user->profile_picture &&
                file_exists(public_path($user->profile_picture))
            ) {
                unlink(public_path($user->profile_picture));
            }

            $image->move($destination, $filename);

            $user->update([
                'profile_picture' => 'images/profile_pictures/' . $filename
            ]);
        }

        return redirect()
            ->route('system_users.user_profile_show')
            ->with('success', 'Profile updated successfully.');
    }
}
