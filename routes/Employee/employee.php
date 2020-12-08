<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Employee\LoginController;
use App\Http\Controllers\Auth\Employee\RegisterController;
use App\Http\Controllers\Auth\Employee\ForgotPasswordController;
use App\Http\Controllers\Auth\Employee\ResetPasswordController;
use App\Http\Controllers\Auth\Employee\ConfirmPasswordController;
use App\Http\Controllers\Auth\Employee\VerificationController;

Route::prefix('employee')->namespace('Auth\Employee')->group(function(){

    // Login Routes...
    // Login Routes...
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('employee.login');
    Route::post('login', [LoginController::class, 'login']);

    // Logout Routes...
    Route::post('logout', [LoginController::class,'logout'])->name('employee.logout');

    // Registration Routes...
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('employee.register');
    Route::post('register', [RegisterController::class, 'register']);

    // Password Reset Routes...
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('employee.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('employee.password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('employee.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    // Password Confirmation Routes...
    Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('employee.password.confirm');
    Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

    // Email Verification Routes...
    Route::get('email/verify', [VerificationController::class, 'show'])->name('employee.verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class,'verify'])->name('employee.verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('employee.verification.resend');

});

Route::prefix('employee')->middleware(['auth:employee', 'verified:employee', 'role:employee'])->group(function (){
    Route::get('/dashboard', [\App\Http\Controllers\Employee\DashboardController::class, 'index'])->name('employee.dashboard');
});
