<?php

use App\Http\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('task')->group(function () {
    Route::get('/list', [TaskController::class, 'list']);
    Route::post('/create', [TaskController::class, 'create']);
    Route::put('/edit', [TaskController::class, 'edit']);
    Route::delete('/delete', [TaskController::class, 'delete']);
    Route::post('/status', [TaskController::class, 'status']);
});

Route::prefix('user')->group(function () {
    Route::get('/list', [UserController::class, 'list']);
});
