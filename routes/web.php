<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::controller(LoginController::class)->group(function () {
    Route::get('autorizacion/iniciar-sesion', 'index')->name('login.index');
    Route::get('/', 'index')->name('login.index');
    Route::post('autorizacion/iniciar-sesion', 'auth')->name('login.auth');
});

Route::controller(WelcomeController::class)->group(function () {
    Route::get('bienvenido-a', '__invoke')->name('welcome');
    Route::get('bienvenido', '__invoke')->name('welcome');
    Route::get('bienvenida', '__invoke')->name('welcome');
});
