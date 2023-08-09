<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware(['auth:user', 'ability:'.TokenAbility::ACCESS_API->value]);
Route::post('/refresh-token', [AuthController::class, 'refreshToken'])
    ->middleware(['auth:user', 'ability:'.TokenAbility::ISSUE_ACCESS_TOKEN->value]);
