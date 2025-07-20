<?php

use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome'); //enable this when you want index page is not your login page
    return redirect()->route('login');
});

// authenticated route
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('postlogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::group([
    'prefix' => '/dashboard',
    'middleware' => 'auth',
], function () {
    Route::prefix('')->name('dashboard.')->group(__DIR__ . '/admin/dashboard.php');
});
