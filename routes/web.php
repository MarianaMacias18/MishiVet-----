<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
        return view('welcome');
    })->name('welcome');
    #Route::GET('/registro',[UserController::class,'create'])->name('users.create'); // Registro Usuario <-
    #Route::POST('/registro',[UserController::class,'store'])->name('users.store');
    #Route::GET('/login',[UserController::class,'loginshow'])->name('users.loginshow'); // Login Usuario <-
    #Route::POST('/login',[UserController::class,'login'])->name('users.login'); 
});

/*
Route::middleware(['auth'])->group(function () {
    Route::POST('/logout',[UserController::class,'logout'])->name('users.logout'); // Logout Usuario <-
    Route::resource('/dashboard/user', UserController::class)->only(['show','edit', 'update','destroy',]) // Editar Perfil
    ->names([
        'show' => 'users.show',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy'=> 'users.destroy',
    ]);
    Route::GET('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');
    Route::GET('/dashboard/nosotros',[DashboardController::class,'nosotros'])->name('dashboard.nosotros');

});
*/
Route::middleware(['auth'])->group(function () {
Route::GET('/dashboard',[DashboardController::class,'index'])->name('dashboard');
});