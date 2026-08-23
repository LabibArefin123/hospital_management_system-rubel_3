<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceScheduleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\RoleController;

//Welcome Page
Route::get('/', [FrontendController::class, 'index'])->name('welcome');

//Important Pages
Route::get('/our-doctors', [FrontendController::class, 'doctor'])->name('doctor');
Route::get('/doctor/{id}', [FrontendController::class, 'doctor_show'])->name('doctor.show');

Route::get('/service', [FrontendController::class, 'service'])->name('service');
Route::get('/service/{id}', [FrontendController::class, 'service_show'])->name('service.show');

Route::get('/our-appointments', [FrontendController::class, 'appointment'])->name('appointment');
Route::post('/appointment-store', [FrontendController::class, 'appointment_store'])->name('appointment.store');

//Payment Part (Optional but functional)
Route::get('/payment/{id}', [FrontendController::class, 'payment_page'])->name('payment.page');
Route::post('/payment-store', [FrontendController::class, 'payment_store'])->name('payment.store');

Route::get('/search-data', [FrontendController::class, 'searchData'])
    ->name('search.data');

//Contact Part
Route::get('/contact-us', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact-store', [FrontendController::class, 'contact_store'])->name('contact.store');
Route::post('/newsletter/subscribe', [FrontendController::class, 'newsletter_store'])->name('newsletter.store');

//Frontend Profile Part
Route::middleware('auth')->group(function () {
    Route::get('/my-profile', function () {
        return view('frontend.profile');
    })->name('frontend.profile');
});

//Auth Routes
require __DIR__ . '/auth.php';

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm']) ->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

//Logout Routes
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

/* AUTHENTICATED ROUTES*/
Route::group(['middleware' => ['auth', 'permission']], function () {
    //Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'default_dashboard'])->name('dashboard.default');
    Route::get('/user-dashboard', [DashboardController::class, 'user_dashboard'])->name('dashboard.user');
    Route::get('/doctor-dashboard', [DashboardController::class, 'doctor_dashboard'])->name('dashboard.doctor');

    //User Profile Routes
    Route::get('/user_profile_show', [ProfileController::class, 'user_profile_show'])->name('system_users.user_profile_show');
    Route::get('/user_profile_edit', [ProfileController::class, 'user_profile_edit'])->name('system_users.user_profile_edit');
    Route::put('/user_profile_edit', [ProfileController::class, 'user_profile_update'])->name('system_users.user_profile_update');

    //Doctor Menu
    Route::resource('doctors', DoctorController::class);
    Route::resource('doctor-schedules', DoctorScheduleController::class);

    //Service Menu
    Route::resource('services', ServiceController::class);
    Route::resource('service-schedules', ServiceScheduleController::class);

    //Appointment Menu
    Route::get('appointments/cancel/{id}', [AppointmentController::class, 'appointment_cancel'])->name('appointments.cancel');
    Route::post('appointments/change-status/{id}', [AppointmentController::class, 'appointment_change'])->name('appointments.change');
    Route::resource('appointments', AppointmentController::class);

    //Payment Menu
    Route::resource('payments', PaymentController::class);

    //Contact Menu
    Route::resource('contacts', ContactController::class);

    //Setting menu
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::post('/permissions/delete-selected', [PermissionController::class, 'deleteSelected'])->name('permissions.deleteSelected');
    Route::resource('system_users', SystemUserController::class);
    Route::post('/system-users/{user}/change-password', [SystemUserController::class, 'updatePassword'])->name('system_users.password.update');
    Route::resource('newsletters', NewsletterController::class);
});
