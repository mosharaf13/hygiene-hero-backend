<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/heartbeats', [App\Http\Controllers\PlayerStatController::class, 'index'])->name('heartbeats.index');
Route::post('/heartbeats', [App\Http\Controllers\PlayerStatController::class, 'store'])->name('heartbeats.store');
Route::put('/heartbeats', [App\Http\Controllers\PlayerStatController::class, 'update'])->name('heartbeats.update');
