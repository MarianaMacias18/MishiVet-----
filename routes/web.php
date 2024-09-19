<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('mishivet');
    Route::GET('/registro',[UserController::class,'create'])->name('users.create'); // Registro Usuario <-
    Route::POST('/registro',[UserController::class,'store'])->name('users.store');
    Route::GET('/login',[UserController::class,'show'])->name('users.show'); // Login Usuario <-
    Route::POST('/login',[UserController::class,'login'])->name('users.login'); 
    Route::POST('/logout',[UserController::class,'logout'])->name('users.logout'); // Logout Usuario <-
});


Route::middleware(['auth'])->group(function () {
    # Rutas protegidas

});
