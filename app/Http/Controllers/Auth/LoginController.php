<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\SystemProblem;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\BanUser;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     */
    protected string $redirectTo = '/dashboard';
    protected string $redirectTo2 = '/doctor_dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Show login page
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login (Crypt-based)
     */

    public function login(LoginRequest $request)
    {
        $request->ensureIsNotRateLimited();

        $loginInput = $request->input('login');

        $password = $request->input('password');

        /*
    |--------------------------------------------------------------------------
    | LOGIN FIELD
    |--------------------------------------------------------------------------
    */

        $field = filter_var($loginInput, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        /*
    |--------------------------------------------------------------------------
    | FIND USER
    |--------------------------------------------------------------------------
    */

        $user = User::where($field, $loginInput)->first();

        /*
    |--------------------------------------------------------------------------
    | USER NOT FOUND
    |--------------------------------------------------------------------------
    */

        if (!$user) {

            return back()->withErrors([
                'login' => trans('auth.failed'),
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | PASSWORD CHECK
    |--------------------------------------------------------------------------
    */

        if (!Hash::check($password, $user->password)) {

            return back()->withErrors([
                'login' => trans('auth.failed'),
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | LOGIN USER
    |--------------------------------------------------------------------------
    */

        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        /*
    |--------------------------------------------------------------------------
    | SUCCESS MESSAGE
    |--------------------------------------------------------------------------
    */

        session()->flash(
            'login_success',
            'Welcome back, ' . Auth::user()->name . '!'
        );

        /*
    |--------------------------------------------------------------------------
    | ROLE BASED REDIRECT
    |--------------------------------------------------------------------------
    */

        if (Auth::user()->hasRole('admin')) {

            return redirect()->route('dashboard.default');
        }

        if (Auth::user()->hasRole('doctor')) {

            return redirect()->route('dashboard.doctor');
        }

        /*
    |--------------------------------------------------------------------------
    | FALLBACK
    |--------------------------------------------------------------------------
    */

        return redirect()->route('dashboard.user');
    }

    /**
     * Handle actions after successful login
     */
    protected function authenticated(Request $request, $user)
    {
        // SweetAlert / toast message
        session()->flash('login_success', 'Welcome back, ' . $user->name . '!');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
