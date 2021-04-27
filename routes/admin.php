<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin'
], function () {
    Route::get('', function () {
        return 200;
    });
});