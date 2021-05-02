<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PersonController;

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


Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [LoginController::class, 'logout']);
});


Route::get('/', [DashController::class, 'index'])->name('index');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/signup', [RegisterController::class, 'index'])->name('signup');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');
});
