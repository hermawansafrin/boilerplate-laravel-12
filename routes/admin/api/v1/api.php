<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/authentication',
], function () {
    Route::prefix('')->name('authentication.')->group(__DIR__ . '/auth.php');
});

Route::group([
    'prefix' => '/settings',
    'middleware' => [
        'auth:sanctum',
        'api.user_has_permission_to:settings',
    ],
], function () {
    Route::prefix('')->name('settings.')->group(__DIR__ . '/settings.php');
});
