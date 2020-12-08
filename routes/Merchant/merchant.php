<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Merchant\LoginController;
use App\Http\Controllers\Auth\Merchant\RegisterController;
use App\Http\Controllers\Auth\Merchant\ForgotPasswordController;
use App\Http\Controllers\Auth\Merchant\ResetPasswordController;
use App\Http\Controllers\Auth\Merchant\ConfirmPasswordController;
use App\Http\Controllers\Auth\Merchant\VerificationController;

Route::prefix('merchant')->namespace('Auth\Merchant')->group(function(){
    // Login Routes...
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('merchant.login');
    Route::post('login', [LoginController::class, 'login']);

    // Logout Routes...
    Route::post('logout', [LoginController::class,'logout'])->name('merchant.logout');

    // Registration Routes...
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('merchant.register');
    Route::post('register', [RegisterController::class, 'register']);

    // Password Reset Routes...
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('merchant.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('merchant.password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('merchant.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('merchant.password.update');

    // Password Confirmation Routes...
    Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('merchant.password.confirm');
    Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

    // Email Verification Routes...
    Route::get('email/verify', [VerificationController::class, 'show'])->name('merchant.verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class,'verify'])->name('merchant.verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('merchant.verification.resend');

});

Route::prefix('merchant')->middleware(['auth:merchant', 'verified:merchant', 'role:merchant'])->group(function (){
    Route::get('/dashboard', [\App\Http\Controllers\Merchant\DashboardController::class, 'index'])->name('merchant.dashboard');
});
