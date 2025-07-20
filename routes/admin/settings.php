<?php

use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')
    ->name('users.')
    ->middleware(['web.user_has_permission_to:settings_user'])
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/get-yajra', [UserController::class, 'getYajra'])->name('getYajra');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [UserController::class, 'destroy'])->name('delete');
    });

Route::prefix('/roles')
    ->name('roles.')
    ->middleware(['web.user_has_permission_to:settings_role'])
    ->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/get-yajra', [RoleController::class, 'getYajra'])->name('getYajra');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [RoleController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [RoleController::class, 'destroy'])->name('delete');
    });
