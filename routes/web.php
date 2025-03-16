<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\PublicController;

// Rota pública
Route::get('/', [PublicController::class, 'index'])->name('public.index');

// Rotas de autenticação
Auth::routes();

// Rotas para atendentes
Route::middleware(['auth', 'attendee'])->group(function () {
    Route::get('/attendee/dashboard', [AttendeeController::class, 'dashboard'])->name('attendee.dashboard');
    Route::get('/attendee/demands', [AttendeeController::class, 'listDemands'])->name('attendee.demands');
});

// Rotas para administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/demands', [AdminController::class, 'listDemands'])->name('admin.demands');
    Route::put('/admin/demands/{id}/status', [AdminController::class, 'updateDemandStatus'])->name('admin.demands.status');
});

// Rota de logout
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
