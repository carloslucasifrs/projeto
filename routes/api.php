<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\AuthenticatedApiController;
use App\Http\Controllers\Api\LaboratoryController;
use App\Http\Controllers\Api\LaboratoryexamController;
use App\Http\Controllers\Api\ReferencevalueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
// */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthenticatedApiController::class, 'login']);
Route::post('/logout', [AuthenticatedApiController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('laboratories', LaboratoryController::class);
    Route::apiResource('laboratoryexams', LaboratoryexamController::class);
    Route::apiResource('referencevalues', ReferencevalueController::class);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
