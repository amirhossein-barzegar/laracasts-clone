<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfirmEmailController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\LessonsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('register/confirm', [ConfirmEmailController::class, 'index'])->name('confirm-email');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', function() {
    return auth()->logout();
});

Route::middleware('admin')->prefix('admin')->group(function() {
    Route::resource('series', SeriesController::class);
    Route::resource('{series_by_id}/lessons', LessonsController::class);
});