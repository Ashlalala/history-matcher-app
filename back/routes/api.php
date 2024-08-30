<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HistoryUnitController;
use App\Models\User;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

// Route::apiResource('user/{userId}/history', UserCon::class)->middleware('auth:sanctum');


Route::apiResource('user/{userId}/history', HistoryController::class)->middleware('auth:sanctum');

Route::apiResource('user/{userId}/history/{historyId}/units', HistoryUnitController::class)->middleware('auth:sanctum');

