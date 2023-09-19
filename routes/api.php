<?php

use App\Http\Controllers\TurbineController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
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
