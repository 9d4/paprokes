<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;

Route::resource('device', DeviceController::class);