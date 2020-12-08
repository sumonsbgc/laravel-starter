<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Admin\RegisterController;
use App\Http\Controllers\Auth\Admin\VerificationController;
use App\Http\Controllers\Auth\Admin\ResetPasswordController;
use App\Http\Controllers\Auth\Admin\ForgotPasswordController;
use App\Http\Controllers\Auth\Admin\ConfirmPasswordController;

// Authentication

Route::prefix('admin')->namespace('Auth\Admin')->group(function(){
    // Login Routes...
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login']);

    // Logout Routes...
    Route::post('logout', [LoginController::class,'logout'])->name('admin.logout');

    // Registration Routes...
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('register', [RegisterController::class, 'register']);

    // Password Reset Routes...
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('admin.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.update');

    // Password Confirmation Routes...
    Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('admin.password.confirm');
    Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

    // Email Verification Routes...
    Route::get('email/verify', [VerificationController::class, 'show'])->name('admin.verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class,'verify'])->name('admin.verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('admin.verification.resend');
});

Route::prefix('admin')->middleware(['auth:admin', 'verified:admin', 'role:admin'])->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Admin Profile Controllers
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/user', [UserController::class, 'store'])->name('admin.user');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');

    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('admin.role.store');

    Route::get('city/{id}', [CityController::class, 'findCityByCountryId'])->name('city');

    Route::get('settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('setting/update', [SettingController::class, 'update'])->name('admin.setting.update');
    
});