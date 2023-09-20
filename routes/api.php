<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TurbineController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/me', 'me');
        Route::post('/logout', 'logout');
    });

    Route::controller(TurbineController::class)->group(function () {
        Route::get('/turbines', 'index');
        Route::post('/turbines', 'store');
        Route::get('/turbines/{id}', 'show')
            ->where('id', '[0-9]+');
        Route::put('/turbines/{id}', 'update')
            ->where('id', '[0-9]+');
        Route::delete('/turbines/{id}', 'destroy')
            ->where('id', '[0-9]+');
    });
});
