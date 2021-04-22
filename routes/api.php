<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\RecordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function () {
    return response()->json([
        'success' => true,
        'status' => 'connection to api OK',
    ], JsonResponse::HTTP_OK);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('all', [RecordController::class, 'index'])->name('api.records');
Route::get('store', [RecordController::class, 'store'])->name('api.record.store');

Route::get('/debug', function (Request $request) {
    return \App\Models\User::create([
        'username' => 'admin',
        'password' => bcrypt('admin'),
    ]);
});
