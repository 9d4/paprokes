<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RecordController;

Route::resource('device', DeviceController::class);

Route::group(['prefix' => 'device'], function () {
    Route::get('{device}/record', [RecordController::class, 'index'])->name('device.record.index');
    Route::get('{device}/now', [RecordController::class, 'realtime'])->name('device.record.now');
});
