<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'note'], function () {
    Route::get('/', [NoteController::class, 'index']);
});
