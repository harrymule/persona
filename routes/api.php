<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserController;
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
Route::prefix("v1")->name('v1')->group(function () {
    Route::post('/auth/register', [AuthController::class, 'createUser']);
    Route::post('/auth/login', [AuthController::class, 'loginUser']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('profile',[UserController::class, 'index']);
        Route::post('profile/{id}',[UserController::class, 'update']);
        Route::post('change_password',[AuthController::class, 'changePassword']);
    });
});

