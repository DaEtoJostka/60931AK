<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return redirect('/countries');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/countries', [CountryController::class, 'index']);
Route::get('/countries/{id}', [CountryController::class, 'show']);

Route::get('/events', [EventController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/events/create', [EventController::class, 'create']);
    Route::post('/events', [EventController::class, 'store']);
    Route::get('/events/{id}/edit', [EventController::class, 'edit']);
    Route::put('/events/{id}', [EventController::class, 'update']);
    Route::delete('/events/{id}', [EventController::class, 'destroy']);
});

Route::get('/events/{id}', [EventController::class, 'show']);
