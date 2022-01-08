<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PersonelController;
use Illuminate\Support\Facades\Route;

Route::get('/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
