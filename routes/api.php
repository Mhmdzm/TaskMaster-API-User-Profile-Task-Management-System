<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('taskss', TaskController::class);

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');


Route::post('profile', [ProfileController::class, 'store']);
Route::post('profile/{id}', [ProfileController::class, 'update']);
Route::get('profile/{id}', [ProfileController::class, 'show']);



Route::get('user/{id}', [UserController::class, 'getProfile']);
