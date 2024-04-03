<?php

use App\Http\Controllers\APIController;
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

Route::get('/contes', [APIController::class, 'contes']);
Route::get('/cavernes', [APIController::class, 'cavernes']);
Route::post('/contes/{id}/eval', [APIController::class, 'evaluerConte']);
Route::get('/app-conf', [APIController::class, 'getAppconfig']);
Route::get('/deploy-release', [APIController::class, 'updateAppVersion' ]);
Route::get('/eord-release', [APIController::class, ''])
