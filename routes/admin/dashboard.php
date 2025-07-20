<?php

use App\Http\Controllers\Web\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('index');

Route::group([
    'prefix' => '/settings',
], function () {
    Route::prefix('')->name('settings.')->middleware(['web.user_has_permission_to:settings'])->group(__DIR__ . '/settings.php');
});
