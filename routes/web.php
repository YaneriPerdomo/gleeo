<?php

use App\Http\Controllers\AlertThresholdsController;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\InitialDecisionPatternsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::controller(LoginController::class)->group(function () {
    Route::get('iniciar-sesion', 'index')->name('login.index');
    Route::get('/', 'index')->name('login.index');
    Route::post('iniciar-sesion', 'auth')->name('login.auth');
    Route::post('cerrar-sesion', 'logout')->name('login.logout');
});

Route::controller(CreateAccountController::class)->group(function () {
    Route::get('crear-nueva-cuenta', 'index')->name('create-account.index');

});

Route::controller(WelcomeController::class)->group(function () {
    Route::get('bienvenido-a', '__invoke')->name('welcome');
    Route::get('bienvenido', '__invoke')->name('welcome');
    Route::get('bienvenida', '__invoke')->name('welcome');
});


Route::controller(RepresentativeController::class)->group(function () {
    Route::get('gestion-de-cuentas/', 'index')->name('representative.index');
    Route::post('gestion-de-cuentas/crear', 'create')->name('representative.create');
    Route::get('gestion-de-cuentas/{search}/filtrar', 'filter')->name('representative.filter');
    Route::get('gestion-de-cuentas/{slug}/editar-informacion', 'edit')->name('representative.edit');
    Route::put('gestion-de-cuentas/{slug}', 'update')->name('representative.update');
    Route::get('gestion-de-cuentas/{slug}/eliminar', 'delete')->name('representative.delete');
    Route::delete('gestion-de-cuentas/{slug}/eliminar', 'destroy')->name('representative.destroy');

});

Route::controller(InitialDecisionPatternsController::class)->group(function () {
    Route::get('configuracion-del-tutor/patrones-de-decision-iniciales', 'index')->name('initial-decision-patterns.index');
    Route::get('configuracion-del-tutor/patrones-de-decision-iniciales/configurar', 'edit')->name('initial-decision-patterns.edit');
    Route::put('configuracion-del-tutor/patrones-de-decision-iniciales/configurar', 'update')->name('initial-decision-patterns.update');
});

Route::controller(AlertThresholdsController::class)->group(function () {
    Route::get('configuracion-del-tutor/alerta-intervencion-requerida', 'index')->name('alert-thresholds.index');
    Route::get('configuracion-del-tutor/alerta-intervencion-requerida/configurar', 'edit')->name('alert-thresholds.edit');
    Route::put('configuracion-del-tutor/alerta-intervencion-requerida/configurar', 'update')->name('alert-thresholds.update');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('perfil/verificacion', 'verification')->name('verification');
    Route::get('perfil/personal', 'IndexPersonal')->name('personal-profile.index');
    Route::get('perfil/cuenta', 'IndexAccount')->name('account-profile.index');
    Route::get('perfil/personal/editar', 'EditPersonal')->name('personal-profile.edit');
    Route::get('perfil/cuenta/editar', 'EditAccount')->name('account-profile.edit');
    Route::put('perfil/cuenta/editar', 'updateAccount')->name('account-profile.update');
    Route::get('perfil/acceso/cambiar', 'ChangePasswordEdit')->name('change-password.edit');
    Route::put('perfil/acceso/cambiar', 'ChangePasswordUpdate')->name('change-password.update');
});
