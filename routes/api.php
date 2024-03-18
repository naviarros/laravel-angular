<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::prefix('items')->group(function () {
    Route::get('/', [ItemController::class, 'index']);
    Route::get('/show', [ItemController::class, 'show']);
    Route::post('/create', [ItemController::class,'store']);
    Route::put('/update', [ItemController::class, 'update']);
    Route::delete('/delete/{id}', [ItemController::class, 'destroy']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
