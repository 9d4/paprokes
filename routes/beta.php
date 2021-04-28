<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RealTimeHistoryController;
use App\Http\Controllers\Api\RecordController;

Route::group(['prefix' => 'beta'], function () {
   Route::view('realtime','dash.realtime.index')->name('beta.realtime');

   Route::get('records', [RecordController::class, 'index']);
});