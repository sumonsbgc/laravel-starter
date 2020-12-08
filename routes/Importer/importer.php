<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Importer\ProfileController;
use App\Http\Controllers\Importer\DashboardController;
use App\Http\Controllers\Auth\Importer\LoginController;
use App\Http\Controllers\Auth\Importer\RegisterController;
use App\Http\Controllers\Auth\Importer\VerificationController;
use App\Http\Controllers\Auth\Importer\ResetPasswordController;
use App\Http\Controllers\Auth\Importer\ForgotPasswordController;
use App\Http\Controllers\Auth\Importer\ConfirmPasswordController;


Route::prefix('importer')->namespace('Auth\Importer')->group(function(){

    // Login Routes...
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('importer.login');
    Route::post('login', [LoginController::class, 'login']);

    // Logout Routes...
    Route::post('logout', [LoginController::class, 'logout'])->name('importer.logout');

    // Registration Routes...
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('importer.register');
    Route::post('register', [RegisterController::class, 'register']);

    // Password Reset Routes...
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('importer.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('importer.password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('importer.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('importer.password.update');

    // Password Confirmation Routes...
    Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('importer.password.confirm');
    Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

    // Email Verification Routes...
    Route::get('email/verify', [VerificationController::class, 'show'])->name('importer.verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class,'verify'])->name('importer.verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('importer.verification.resend');

});

Route::prefix('importer')->middleware(['auth:importer', 'verified:importer', 'role:importer'])->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('importer.dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('importer.profile');
});
