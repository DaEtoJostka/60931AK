<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return redirect('/countries');
});

Route::get('/countries', [CountryController::class, 'index']);
Route::get('/countries/{id}', [CountryController::class, 'show']);

Route::get('/events', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create']);
Route::post('/events', [EventController::class, 'store']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::get('/events/{id}/edit', [EventController::class, 'edit']);
Route::put('/events/{id}', [EventController::class, 'update']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);
