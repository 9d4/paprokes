<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RecordController;

Route::resource('device', DeviceController::class);

Route::group(['prefix' => 'device'], function () {
    Route::get('{device}/record', [RecordController::class, 'index'])->name('device.record.index');
});
