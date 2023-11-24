<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
    Route::get('/{id_user}/user', [\App\Http\Controllers\UserController::class, 'show']);
    Route::post('/user', [\App\Http\Controllers\UserController::class, 'store']);
    Route::patch('/{id_user}/user', [\App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/{id_user}/user', [\App\Http\Controllers\UserController::class, 'destroy']);
});
