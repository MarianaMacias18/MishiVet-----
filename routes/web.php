<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KittenController;
use App\Http\Controllers\ShelterController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialiteController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('mishivet');
    })->name('mishivet');

    Route::get('/registro', [UserController::class, 'create'])->name('users.create'); // Registro Usuario
    Route::post('/registro', [UserController::class, 'store'])->name('users.store');
    
    Route::get('/login', [UserController::class, 'loginshow'])->name('users.loginshow'); // Login Usuario
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
    // Socialite Laravel (Github)
    Route::get('/auth/github', [SocialiteController::class, 'redirectToGitHub'])->name('login.github');
    Route::get('/auth/callback', [SocialiteController::class, 'handleGitHubCallback']);
    
});

Route::middleware(['auth','verified'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout'); // Logout Usuario
    
    Route::resource('/dashboard/user', UserController::class)->only(['show', 'edit', 'update', 'destroy'])->names([
        'show' => 'users.show',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);
    
    Route::resource('shelters', ShelterController::class);
    Route::resource('events', EventController::class);
    Route::resource('kittens', KittenController::class);
    

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/nosotros', [DashboardController::class, 'nosotros'])->name('dashboard.nosotros');
});

// contactanos
//Route::get('/contatanos', [ContactanosController::class, 'index'])->name('contactanos.index');
//Route::post('/contatanos', [ContactanosController::class, 'store'])->name('contactanos.store');




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
