<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('google_id', $googleUser->id)
            ->orWhere('email', $googleUser->email)
            ->first();

        // If user does not exist → create
        if (!$user) {

            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'username' => Str::slug($googleUser->name) . rand(100, 999),
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => bcrypt('12345678'),
            ]);

            // ✅ Assign default USER role
            $user->assignRole('user');
        }

        // If existing account has no google_id
        if (!$user->google_id) {
            $user->update([
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
            ]);
        }

        // ✅ Login user
        Auth::login($user, true);

        session()->regenerate();
        session()->save();

        // ✅ Redirect based on role
        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard');
        }

        if ($user->hasRole('user')) {
            return redirect()->route('welcome');
        }

        return redirect()->route('welcome');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
}
