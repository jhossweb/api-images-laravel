<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Images\ImageController;
use App\Http\Controllers\Users\UserController;
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
Route::post("/auth/login", [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get("/images", [ImageController::class, 'index']);
    Route::post("/images", [ImageController::class, 'store']);

});

Route::post("/users", [UserController::class, 'store']);

