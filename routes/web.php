<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

// Rota de login (acesso público)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Envio do formulário de login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Rotas protegidas
Route::middleware(['jwt.web', 'auth:web'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::resource('tasks', TaskController::class); 
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});