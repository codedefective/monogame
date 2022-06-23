<?php

use App\Http\Controllers\Api\Backoffice\AdministratorController;
use App\Http\Controllers\Api\Backoffice\AuthController as AuthControllerForBackoffice;
use App\Http\Controllers\Api\Backoffice\PlayerController;
use App\Http\Controllers\Api\Backoffice\PromotionController;
use App\Http\Controllers\Api\Backoffice\UserManageController;
use App\Http\Controllers\Api\User\AuthController as AuthControllerForUser;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\WalletTransactionController;
use Illuminate\Support\Facades\Route;

const DEFAULT_AUTH_GUARD = "auth:sanctum";

Route::middleware([DEFAULT_AUTH_GUARD,'ability:user_api'])->prefix('/')->group(function () {
    Route::post('/login', [AuthControllerForUser::class,'login'])->withoutMiddleware([DEFAULT_AUTH_GUARD,'ability:user_api']);
    Route::get('/user', [UserController::class,'user']);
    Route::post('/assign-promotion', [PromotionController::class,'assignToUser']);
    Route::get('/balance', [UserController::class,'balance']);
});

Route::middleware([DEFAULT_AUTH_GUARD,'ability:admin_api'])->prefix('/backoffice')->group(function () {
    Route::post('/login', [AuthControllerForBackoffice::class, 'login'])->withoutMiddleware([DEFAULT_AUTH_GUARD,'ability:admin_api']);
    Route::get('/user', [AdministratorController::class, 'user']);
    Route::post('/transaction/deposit', [PlayerController::class, 'deposit']);
    Route::post('/transaction/withdraw', [PlayerController::class, 'withdraw']);
    Route::prefix('/promotion-codes')->group(function () {
        Route::get('/', [PromotionController::class, 'all']);
        Route::get('/{id}', [PromotionController::class, 'find']);
        Route::post('/', [PromotionController::class, 'create']);
        Route::patch('/{promotion_id}', [PromotionController::class, 'update']);
    });

    Route::prefix('/manage-user')->group(function () {
        Route::get('/', [UserManageController::class, 'all']);
        Route::get('/{id}', [UserManageController::class, 'getById']);
        Route::get('/username/{username}', [UserManageController::class, 'getByUserName']);
        Route::post('/', [UserManageController::class, 'create']);
        Route::patch('/{user}', [UserManageController::class, 'update']);
        Route::delete('/{user}', [UserManageController::class, 'delete']);
    });
});

Route::middleware([DEFAULT_AUTH_GUARD,'ability:game_play'])->post('/v3/{process}',[WalletTransactionController::class,'process']);
