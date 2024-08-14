<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerStatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/player-stats', [PlayerStatController::class, 'index'])->name('player-stats.index');
Route::get('/heartbeat-threshold/{playerId}', [PlayerStatController::class, 'threshold']);
Route::get('/player-stats/latest/{playerId}', [PlayerStatController::class, 'latest'])->name('player-stats.latest');
Route::get('/player-stats/submit', [PlayerStatController::class, 'store'])->name('player-stats.submit');
Route::post('/player-stats', [PlayerStatController::class, 'store'])->name('player-stats.store');
Route::put('/player-stats', [PlayerStatController::class, 'update'])->name('player-stats.update');

Route::get('/player-stats/next-player-id', [PlayerStatController::class, 'getNextPlayerId'])->name('player-stats.next-player-id');
