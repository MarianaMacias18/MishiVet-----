<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('mishivet');
    })->name('mishivet');

    Route::get('/registro', [UserController::class, 'create'])->name('users.create'); // Registro Usuario
    Route::post('/registro', [UserController::class, 'store'])->name('users.store');
    
    Route::get('/login', [UserController::class, 'loginshow'])->name('users.loginshow'); // Login Usuario
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
    
});

Route::middleware(['auth','verified'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout'); // Logout Usuario
    
    Route::resource('/dashboard/user', UserController::class)->only(['show', 'edit', 'update', 'destroy'])->names([
        'show' => 'users.show',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/nosotros', [DashboardController::class, 'nosotros'])->name('dashboard.nosotros');
});

// Verificación de correo <-
//------------------------------------------------------------------------
Route::get('/email/verify', function () { //Vista 
    return view('Users.verification'); 
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [UserController::class, 'verify']) //Verificacion
 ->middleware(['signed'])->name('verification.verify');

 Route::post('/email/resend', [UserController::class, 'resendVerificationEmail']) //Reenvio
 ->middleware(['throttle:6,1'])
 ->name('verification.send');
//------------------------------------------------------------------------

