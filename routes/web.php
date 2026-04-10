<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AdminController;

// Auth
Route::get('/',        fn() => redirect('/login'));
Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login']);
Route::get('/register',[AuthController::class, 'showRegister']);
Route::post('/register',[AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Utilisateur (connecté)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DocumentController::class, 'index']);
    Route::post('/documents', [DocumentController::class, 'store']);
    Route::patch('/documents/{document}/toggle', [DocumentController::class, 'toggleTermine']);
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy']);
});

// Admin uniquement
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser']);
});
