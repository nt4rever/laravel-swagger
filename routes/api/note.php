<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::delete('/{category:id}', [CategoryController::class, 'destroy']);
});

Route::group(['prefix' => 'note'], function () {
    Route::get('/', [NoteController::class, 'index']);
});
