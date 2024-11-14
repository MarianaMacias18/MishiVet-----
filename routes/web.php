<?php

use App\Http\Controllers\AdoptionUserKittenController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KittenController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ShelterController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialiteController;

Route::middleware(['guest'])->group(function () {
    // RUTA PAGINA PRINCIPAL <-
    Route::get('/', function () {
        return view('mishivet');
    })->name('mishivet');
    #------------------------------------------------------------------------------------------------------
    // RUTAS LOGIN Y REGISTRO DE USUARIOS
    Route::get('/registro', [UserController::class, 'create'])->name('users.create'); // Registro Usuario
    Route::post('/registro', [UserController::class, 'store'])->name('users.store');
    Route::get('/login', [UserController::class, 'loginshow'])->name('users.loginshow'); // Login Usuario
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
    #------------------------------------------------------------------------------------------------------
    // Socialite Laravel (Github)
    Route::get('/auth/github', [SocialiteController::class, 'redirectToGitHub'])->name('login.github');
    Route::get('/auth/callback', [SocialiteController::class, 'handleGitHubCallback']);
});

Route::middleware(['auth','verified'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout'); // Logout Usuario
    //RUTAS CRUD'S (USERS, SHELTERS, EVENTS, KITTENS) <-
    Route::resource('/dashboard/user', UserController::class)->only(['show', 'edit', 'update', 'destroy'])->names([
        'show' => 'users.show',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);
    Route::resource('/dashboard/admin/shelters', ShelterController::class);
    Route::resource('/dashboard/admin/events', EventController::class);
    Route::resource('/dashboard/admin/kittens', KittenController::class);
  
    #----------------------------------------------------------------------------------------------------------
    // RUTAS NOTIFICACIONES <-
    Route::post('/dashboard/adoptar/{kitten}', [NotificationController::class, 'store'])->name('notifications.store'); # Notificacion de Adopcion pendiente <- (Usuario)
    Route::delete('/dashboard/adoptar/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy'); # Notificacion de Adopcion finalizada <- (Usuario)
    Route::post('/dashboard/adoptar/aceptar/{kitten}', [NotificationController::class, 'accept'])->name('notifications.accept'); # Notficacion aceptada adopcion <- (Dueño)
    Route::post('/dashboard/adoptar/rechazar/{kitten}', [NotificationController::class, 'reject'])->name('notifications.reject'); # Notficacion rechazada adopcion <- (Dueño)
    # ------------------------------------------------------------------------------------------------------------------------------
    # RUTAS DASHBOARD <-
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/detalles/{kitten}', [DashboardController::class, 'kitten'])->name('dashboard.kittens.show');
    
    // RUTA HISTORIAL DE ADOPCIONES <-
    Route::get('/dashboard/historial/adopciones', [AdoptionUserKittenController::class, 'indexAdoptador'])
            ->name('adoption-history');
    Route::get('/dashboard/historial/adopciones/refugios/{shelter}', [AdoptionUserKittenController::class, 'indexDueno'])
            ->name('shelter-adoption-history');
    
    // RUTA GENERAR PDF <-
    Route::get('/generar-pdf/{kitten}', [DashboardController::class, 'generarPDF'])->name('doc.pdf');
    // RUTA GENERAR PAGO/DONACION <-
    Route::get('/payment/{kitten}', [DashboardController::class,'generarDONACION'])->name('dashboard.donate');
    Route::post('/pay/{shelter}', [DashboardController::class, 'pay'])->name('dashboard.pay');
    Route::get('/dashboard/donations', [DashboardController::class, 'donations'])->name('donations.index');

    Route::get('/dashboard/nosotros', [DashboardController::class, 'nosotros'])->name('dashboard.nosotros');
    Route::get('/dashboard/notificaciones', [DashboardController::class, 'notificaciones'])->name('dashboard.notificaciones');
    Route::get('/dashboard/admin/notificaciones', [DashboardController::class, 'ADMINnotificaciones'])->name('dashboard.admin.notificaciones');

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
