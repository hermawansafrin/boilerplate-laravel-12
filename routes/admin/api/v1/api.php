<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/authentication',
], function () {
    Route::prefix('')->name('authentication.')->group(__DIR__ . '/auth.php');
});
