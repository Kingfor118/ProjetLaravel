<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvtSportifController;
//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/events', [EvtSportifController::class, 'store']);
    Route::delete('/events/{id}', [EvtSportifController::class, 'destroy']);
    Route::put('/events/{id}', [EvtSportifController::class, 'update']);
});



Route::get('/events', [EvtSportifController::class, 'index']);
Route::get('/events/{slug?}/{id?}', [EvtSportifController::class, 'show']);

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/inscription', [UserController::class, 'Inscription']);
    Route::get('/inscription', [UserController::class, 'ListInscription']);
    Route::delete('/inscription/{id}', [UserController::class, 'Desinscription']);
});
