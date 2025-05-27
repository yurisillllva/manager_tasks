<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Rotas Públicas (Web)
Route::get('/', function () {
    return view('welcome');
});

// Rotas Protegidas (Web)
Route::middleware(['auth'])->group(function () { // Use 'auth' padrão para web
    Route::resource('tasks', TaskController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Rotas de Autenticação (API)
Route::prefix('api')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});