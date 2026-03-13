<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Frontend\AgendaCulturalController;
use App\Http\Controllers\Frontend\ClassificadosController;
use App\Http\Controllers\Frontend\GuiaLocalController;
use App\Http\Controllers\Frontend\VagasEmpregoController;
use App\Http\Controllers\Portal\AgendaController as PortalAgendaController;
use App\Http\Controllers\Portal\ClassificadoController as PortalClassificadoController;
use App\Http\Controllers\Portal\DashboardController as PortalDashboardController;
use App\Http\Controllers\Portal\GuiaLocalController as PortalGuiaLocalController;
use App\Http\Controllers\Portal\VagaController as PortalVagaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('portal.dashboard'));

Route::get('/agenda-cultural/{date}/{slug}', [AgendaCulturalController::class, 'show'])
    ->where('date', '[0-9]{4}-[0-9]{2}-[0-9]{2}')
    ->name('public.agenda.show');

Route::get('/guia-local/{category}', [GuiaLocalController::class, 'index'])->name('public.guia.index');
Route::get('/vagas-de-emprego/{slug}', [VagasEmpregoController::class, 'show'])->name('public.vagas.show');
Route::get('/classificados/{slug}', [ClassificadosController::class, 'show'])->name('public.classificados.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::prefix('/portal')->name('portal.')->group(function () {
        Route::get('/', PortalDashboardController::class)->name('dashboard');

        Route::get('/agenda-cultural', [PortalAgendaController::class, 'index'])->name('agenda.index');
        Route::post('/agenda-cultural', [PortalAgendaController::class, 'store'])->name('agenda.store');

        Route::get('/guia-local', [PortalGuiaLocalController::class, 'index'])->name('guia.index');
        Route::post('/guia-local', [PortalGuiaLocalController::class, 'store'])->name('guia.store');

        Route::get('/vagas-de-emprego', [PortalVagaController::class, 'index'])->name('vagas.index');
        Route::post('/vagas-de-emprego', [PortalVagaController::class, 'store'])->name('vagas.store');

        Route::get('/classificados', [PortalClassificadoController::class, 'index'])->name('classificados.index');
        Route::post('/classificados', [PortalClassificadoController::class, 'store'])->name('classificados.store');
    });

    Route::middleware('super.admin')->group(function () {
        Route::get('/admin', AdminDashboardController::class)->name('admin.dashboard');
    });
});
