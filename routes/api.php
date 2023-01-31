<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ShareCarController;
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



Route::group(['prefix' => '/cars/{car}'], function () {
    Route::get('is_accessible', [ShareCarController::class, 'isAccessible']);
    Route::post('share', [ShareCarController::class, 'share']);
    Route::post('release', [ShareCarController::class, 'release']);
    Route::post('lock', [ShareCarController::class, 'lock']);
});
