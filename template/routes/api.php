<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/updates', [\App\Http\Controllers\DashboardController::class, 'updates']);
Route::post('/history_metar', [\App\Http\Controllers\MetarController::class, 'getHistory']);
Route::post('/history_pengamatan', [\App\Http\Controllers\PengamatanController::class, 'getHistory']);
Route::post('/metar_updates', [\App\Http\Controllers\DashboardController::class, 'metarUpdates']);

