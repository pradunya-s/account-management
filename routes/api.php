<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\TransactionController;

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
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // Account Routes
    Route::post('/accounts', [AccountController::class, 'create']);
    Route::get('/accounts/{account_number}', [AccountController::class, 'show']);
    Route::put('/accounts/{account_number}', [AccountController::class, 'update']);
    Route::delete('/accounts/{account_number}', [AccountController::class, 'deactivate']);

    // Transaction Routes
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::get('/transactions', [TransactionController::class, 'index']);
});
