<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/v1',
], function () {
    Route::prefix('')->name('api.v1.')->group(__DIR__ . '/admin/api/v1/api.php');
});
