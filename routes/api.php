<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserPermissionController;
use App\Http\Controllers\Api\AddressController;

Route::post('auth/login', [AuthController::class, 'login']);
Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('users', UserController::class);
    Route::post('users/{user}/permissions', [UserPermissionController::class, 'assign']);
    Route::post('users/{user}/addresses', [AddressController::class, 'store']);
});
