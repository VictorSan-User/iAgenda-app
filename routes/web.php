<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return redirect()->route('login');
});

use App\Http\Controllers\UserController;
//rota p login
Route::get('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
//rota p registro
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store']);

//rota p perfil dps de logado
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//rota p dashboard dps de logado
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});
