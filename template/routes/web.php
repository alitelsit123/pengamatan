<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/config_cache', function() {
//     \Artisan::call('config:cache');
//     return 'cached';
// });

Route::name('base')->middleware(['auth'])->group(function() {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'view']);

    Route::get('/pengamatan', [\App\Http\Controllers\PengamatanController::class, 'view']);

    Route::get('/metar', [\App\Http\Controllers\MetarController::class, 'view']);

    Route::get('/setting', [\App\Http\Controllers\SettingController::class, 'view']);
    Route::post('/setting/update', [\App\Http\Controllers\SettingController::class, 'update']);

    Route::get('/tentang', function () {
        return view('pages.tentang');
    });
});
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'viewLogin']);
Route::get('/forget', [\App\Http\Controllers\AuthController::class, 'viewForget']);

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware(['auth']);
Route::post('/updates', [\App\Http\Controllers\DashboardController::class, 'updates']);
Route::post('/metar_updates', [\App\Http\Controllers\DashboardController::class, 'metarUpdates']);
Route::post('/get_exports', [\App\Http\Controllers\DashboardController::class, 'get_all']);