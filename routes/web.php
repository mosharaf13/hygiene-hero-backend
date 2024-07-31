<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/player-stats', [App\Http\Controllers\PlayerStatController::class, 'index'])->name('player-stats.index');
Route::get('/player-stats/latest', [App\Http\Controllers\PlayerStatController::class, 'latest'])->name('player-stats.latest');
Route::get('/player-stats/submit', [App\Http\Controllers\PlayerStatController::class, 'store'])->name('player-stats.submit');
Route::post('/player-stats', [App\Http\Controllers\PlayerStatController::class, 'store'])->name('player-stats.store');
Route::put('/player-stats', [App\Http\Controllers\PlayerStatController::class, 'update'])->name('player-stats.update');
