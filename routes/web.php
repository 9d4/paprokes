<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::get('/dash', [DashController::class, 'index'])->middleware(['auth'])->name('dashboard');


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout.post');

    Route::prefix('/dash')->group(function () {
        Route::resource('/person', PersonController::class);
        Route::group(['prefix' => '/history'], function () {
            Route::get('', [HistoryController::class, 'all'])->name('history.all');
            Route::get('reg', [HistoryController::class, 'registered'])->name('history.reg');
            Route::get('unreg', [HistoryController::class, 'unregistered'])->name('history.unreg');
            Route::get('high', [HistoryController::class, 'high'])->name('history.high');
            Route::get('normal', [HistoryController::class, 'normal'])->name('history.normal');
        });
        include 'beta.php';
    });
    include 'admin.php';
});

Route::get('debug', function () {

});