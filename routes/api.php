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
    Route::post('auth/sign-in', [\App\Http\Controllers\AuthController::class, 'signIn']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('auth/sign-out', [\App\Http\Controllers\AuthController::class, 'signOut']);
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [\App\Http\Controllers\UserController::class, 'index']);
            Route::get('/user-summary', [\App\Http\Controllers\UserController::class, 'summary']);
            Route::get('/{id_user}/user', [\App\Http\Controllers\UserController::class, 'show']);
            Route::post('/', [\App\Http\Controllers\UserController::class, 'store']);
            Route::patch('/{id_user}/user', [\App\Http\Controllers\UserController::class, 'update']);
            Route::delete('/{id_user}/user', [\App\Http\Controllers\UserController::class, 'destroy']);
        });
    });
});
