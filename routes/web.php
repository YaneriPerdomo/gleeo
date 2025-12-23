<?php

use App\Http\Controllers\AlertThresholdsController;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\InitialDecisionPatternsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\StudyPlanController;
use App\Http\Controllers\TopicController;
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

Route::controller(StudyPlanController::class)->group(function () {
    Route::get('plataforma-educativa/plan-de-estudio', 'index')->name('study-plan.index');
    Route::get('plataforma-educativa/plan-de-estudio/agregar', 'create')->name('study-plan.create');
    Route::get('plataforma-educativa/plan-de-estudio/{search}/filtrar', 'filter')->name('study-plan.filter');
    Route::post('plataforma-educativa/plan-de-estudio/agregar', 'store')->name('study-plan.store');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}', 'level')->name('study-plan.level-index');

});


Route::controller(ModuleController::class)->group(function () {
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/modulo/{slug}/editar', 'edit')->name('module.edit');
    Route::put('plataforma-educativa/plan-de-estudio/{nivel}/modulo/{slug}/actualizar', 'update')->name('module.update');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/modulo/{slug}/eliminar', 'delete')->name('module.delete');
    Route::delete('plataforma-educativa/plan-de-estudio/{nivel}/modulo/{slug}/eliminar', 'destroy')->name('module.destroy');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/modulo/crear', 'create')->name('module.create');
    Route::post('plataforma-educativa/plan-de-estudio/{nivel}/modulo/crear', 'store')->name('module.store');
});

Route::controller(TopicController::class)->group(function () {
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/tema/{slug}/agregar', 'create')->name('topic.create');
    Route::post('plataforma-educativa/plan-de-estudio/{nivel}/tema/{slug}/agregar', 'store')->name('topic.store');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/tema/{slug}/eliminar', 'delete')->name('topic.delete');
    Route::delete('plataforma-educativa/plan-de-estudio/{nivel}/tema/{slug}/eliminar', 'destroy')->name('topic.destroy');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/tema/{slug}/editar', 'edit')->name('topic.edit');
    Route::put('plataforma-educativa/plan-de-estudio/{nivel}/tema/{slug}/actualizar', 'update')->name('topic.update');
});
