<?php

use App\Http\Controllers\AlertThresholdsController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\EducationalPlatformController;
use App\Http\Controllers\GlobalRankingController;
use App\Http\Controllers\InitialDecisionPatternsController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NewsBoardController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\StudyPlanController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\WelcomeController;
use App\Models\Children;
use App\Models\NewsBoard;
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

Route::controller(WelcomeController::class)->middleware(['auth'])->group(function () {
    Route::get('inicio', '__invoke')->name('welcome');
});

Route::controller(RepresentativeController::class)->group(function () {
     Route::post('gestion-de-cuentas/representante-y-profesionale/crear', 'create')->name('representative.create');
    });

Route::controller(RepresentativeController::class)->middleware(['auth'])->group(function () {
    Route::get('gestion-de-cuentas/representantes-y-profesionales', 'index')->name('representative.index');
     Route::get('gestion-de-cuentas/representantes-y-profesionales/{search}/filtrar', 'filter')->name('representative.filter');
    Route::get('gestion-de-cuentas/representante-y-profesionale/{slug}/editar-informacion', 'edit')->name('representative.edit');
    Route::put('gestion-de-cuentas/representante-y-profesionale/{slug}', 'update')->name('representative.update');
    Route::get('gestion-de-cuentas/representante-y-profesionale/{slug}/eliminar', 'delete')->name('representative.delete');
    Route::delete('gestion-de-cuentas/representante-y-profesionale/{slug}/eliminar', 'destroy')->name('representative.destroy');
});

Route::controller(InitialDecisionPatternsController::class)->middleware(['auth'])->group(function () {
    Route::get('configuracion-del-tutor/patrones-de-decision-iniciales', 'index')->name('initial-decision-patterns.index');
    Route::get('configuracion-del-tutor/patrones-de-decision-iniciales/configurar', 'edit')->name('initial-decision-patterns.edit');
    Route::put('configuracion-del-tutor/patrones-de-decision-iniciales/configurar', 'update')->name('initial-decision-patterns.update');
});

Route::controller(AlertThresholdsController::class)->middleware(['auth'])->group(function () {
    Route::get('configuracion-del-tutor/alerta-intervencion-requerida', 'index')->name('alert-thresholds.index');
    Route::get('configuracion-del-tutor/alerta-intervencion-requerida/configurar', 'edit')->name('alert-thresholds.edit');
    Route::put('configuracion-del-tutor/alerta-intervencion-requerida/configurar', 'update')->name('alert-thresholds.update');
});

Route::controller(ProfileController::class)->middleware(['auth'])->group(function () {
    Route::get('perfil/cuenta', 'IndexAccount')->name('account-profile.index');
    Route::get('perfil/personal/editar', 'EditPersonal')->name('personal-profile.edit');
    Route::get('perfil/cuenta/editar', 'EditAccount')->name('account-profile.edit');
    Route::put('perfil/cuenta/editar', 'updateAccount')->name('account-profile.update');
    Route::get('perfil/acceso/cambiar', 'ChangePasswordEdit')->name('change-password.edit');
    Route::put('perfil/acceso/cambiar', 'ChangePasswordUpdate')->name('change-password.update');
    Route::get('perfil/personal', 'IndexPersonal')->name('personal-profile.index');
    Route::get('perfil/personal/editar', 'EditPersonal')->name('personal-profile.edit');
    Route::put('perfil/personal/editar', 'updatePersonal')->name('personal-profile.update');
});

Route::controller(StudyPlanController::class)->middleware(['auth'])->group(function () {
    Route::get('plataforma-educativa/plan-de-estudio', 'index')->name('study-plan.index');
    Route::get('plataforma-educativa/plan-de-estudio/agregar', 'create')->name('study-plan.create');
    Route::get('plataforma-educativa/plan-de-estudio/{search}/filtrar', 'filter')->name('study-plan.filter');
    Route::post('plataforma-educativa/plan-de-estudio/agregar', 'store')->name('study-plan.store');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}', 'level')->name('study-plan.level-index');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/eliminar', 'delete')->name('study-plan.level-delete');
    Route::delete('plataforma-educativa/plan-de-estudio/{nivel}/eliminar', 'destroy')->name('study-plan.level-destroy');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/editar', 'edit')->name('study-plan.level-edit');
    Route::put('plataforma-educativa/plan-de-estudio/{nivel}/editar', 'update')->name('study-plan.level-update');
});

Route::controller(LessonController::class)->middleware(['auth'])->group(function () {
    Route::post('plataforma-educativa/plan-de-estudio/{nivel}/tema/{topic_slug}/leccion/agregar', 'store')->name('lesson.store');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/tema/{topic_slug}/leccion/agregar', 'create')->name('lesson.create');
});

Route::controller(ModuleController::class)->middleware(['auth'])->group(function () {
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/modulo/{slug}/editar', 'edit')->name('module.edit');
    Route::put('plataforma-educativa/plan-de-estudio/{nivel}/modulo/{slug}/actualizar', 'update')->name('module.update');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/modulo/{slug}/eliminar', 'delete')->name('module.delete');
    Route::delete('plataforma-educativa/plan-de-estudio/{nivel}/modulo/{slug}/eliminar', 'destroy')->name('module.destroy');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/modulo/crear', 'create')->name('module.create');
    Route::post('plataforma-educativa/plan-de-estudio/{nivel}/modulo/crear', 'store')->name('module.store');
});

Route::controller(TopicController::class)->middleware(['auth'])->group(function () {
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/modulo/{slug}/tema/agregar', 'create')->name('topic.create');
    Route::post('plataforma-educativa/plan-de-estudio/{nivel}/modulo/{slug}/tema/agregar', 'store')->name('topic.store');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/tema/{slug}/eliminar', 'delete')->name('topic.delete');
    Route::delete('plataforma-educativa/plan-de-estudio/{nivel}/tema/{slug}/eliminar', 'destroy')->name('topic.destroy');
    Route::get('plataforma-educativa/plan-de-estudio/{nivel}/tema/{slug}/editar', 'edit')->name('topic.edit');
    Route::put('plataforma-educativa/plan-de-estudio/{nivel}/tema/{slug}/actualizar', 'update')->name('topic.update');
});

Route::controller(ChildrenController::class)->middleware(['auth'])->group(function () {
    Route::get('gestion-de-cuentas/jugadores', 'index')->name('children.index');
    Route::get('gestion-de-cuentas/jugador/agregar', 'create')->name('children.create');
    Route::post('gestion-de-cuentas/jugador/agregar', 'store')->name('children.store');
});

Route::controller(EducationalPlatformController::class)->middleware(['auth'])->group(function () {
    Route::get('bienvenida', 'welcome')->name('educational-platform.welcome-m');
    Route::get('bienvenido', 'welcome')->name('educational-platform.welcome-f');
    Route::get('niveles/{slugCurrentLevel}', 'index')->name('educational-platform.index');
    Route::post('current-level-by-the-player/{levelID}', 'currentLevelUpdate')->name('educational-platform.current-level-update');
});

Route::get('niveles/{slugCurrentLevel}/ranking-global', GlobalRankingController::class)->middleware(['auth'])->name('ranking-global.index');

Route::controller(PlayerController::class)->middleware(['auth'])->group(function () {
    Route::get('niveles/{level}/{module}/{topic}/{lesson}', 'gamingExperience')->name('player.gaming-experience');
});

Route::controller(ProgressController::class)->middleware(['auth'])->group(function () {
    Route::get('niveles/{slugCurrentLevel}/progreso', 'player')->name('progress.index');
});


Route::controller(ThemeController::class)->middleware(['auth'])->group(function () {
    Route::get('plataforma-educativa/temas-de-interfaz', 'index')->name('theme.index');
    Route::get('plataforma-educativa/temas-de-interfaz/{search}/filtrar', 'filter')->name('theme.filter');
    Route::get('plataforma-educativa/temas-de-interfaz/agregar', 'create')->name('theme.create');
    Route::post('plataforma-educativa/temas-de-interfaz/agregar', 'store')->name('theme.store');
    Route::get('plataforma-educativa/temas-de-interfaz/{slug}/eliminar ', 'delete')->name('theme.delete');
    Route::delete('plataforma-educativa/temas-de-interfaz/{slug}/eliminar', 'destroy')->name('theme.destroy');

});

Route::controller(AvatarController::class)->middleware(['auth'])->group(function () {
    Route::get('plataforma-educativa/avatares', 'index')->name('avatar.index');
    Route::get('plataforma-educativa/avatares/{search}/filtrar', 'filter')->name('avatar.filter');
    Route::post('plataforma-educativa/avatar/agregar', 'store')->name('avatar.store');
    Route::get('plataforma-educativa/avatar/agregar', 'create')->name('avatar.create');
    Route::get('plataforma-educativa/avatar/{slug}/eliminar', 'delete')->name('avatar.delete');
    Route::delete('plataforma-educativa/avatar/{slug}/eliminar', 'destroy')->name('avatar.destroy');
});

Route::controller(NewsBoardController::class)->middleware(['auth'])->group(function () {
    Route::get('plataforma-educativa/informacion-general', 'index')->name('news-board.index');
    Route::get('plataforma-educativa/informacion-general/editar', 'edit')->name('news-board.edit');
    Route::put('plataforma-educativa/informacion-general', 'update')->name('news-board.update');
});
