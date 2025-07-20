<?php

use App\Http\Controllers\Api\RoleController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'roles',
    'as' => 'roles.',
    'middleware' => [
        'api.user_has_permission_to:settings_role',
    ],
], function () {
    Route::get('/', [RoleController::class, 'paginate'])->name('index');
    Route::get('/{id}', [RoleController::class, 'show'])->name('show');
    Route::post('/', [RoleController::class, 'store'])->name('store')->middleware('api.user_has_permission_to:settings_role_add');
    Route::put('/{id}', [RoleController::class, 'update'])->name('update')->middleware('api.user_has_permission_to:settings_role_edit');
    Route::delete('/{id}', [RoleController::class, 'destroy'])->name('destroy')->middleware('api.user_has_permission_to:settings_role_delete');
});
