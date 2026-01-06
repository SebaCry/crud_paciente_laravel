<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('pacientes', PacienteController::class);
    Route::get('/municipios/{departamento}', [PacienteController::class]);
});
