<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Courier\LoginController;
use App\Http\Controllers\Auth\Courier\RegisterController;
use App\Http\Controllers\Auth\Courier\ForgotPasswordController;
use App\Http\Controllers\Auth\Courier\ResetPasswordController;
use App\Http\Controllers\Auth\Courier\ConfirmPasswordController;
use App\Http\Controllers\Auth\Courier\VerificationController;


Route::prefix('courier')->namespace('Auth\Courier')->group(function(){

    // Login Routes...
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('courier.login');
    Route::post('login', [LoginController::class, 'login']);

    // Logout Routes...
    Route::post('logout', [LoginController::class,'logout'])->name('courier.logout');

    // Registration Routes...
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('courier.register');
    Route::post('register', [RegisterController::class, 'register']);

    // Password Reset Routes...
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('courier.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('courier.password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('courier.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('courier.password.update');

    // Password Confirmation Routes...
    Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('courier.password.confirm');
    Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

    // Email Verification Routes...
    Route::get('email/verify', [VerificationController::class, 'show'])->name('courier.verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class,'verify'])->name('courier.verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('courier.verification.resend');

});

Route::prefix('courier')->middleware(['auth:courier', 'verified:courier', 'role:courier'])->group(function (){
    Route::get('/dashboard', [\App\Http\Controllers\Courier\DashboardController::class, 'index'])->name('courier.dashboard');
});
