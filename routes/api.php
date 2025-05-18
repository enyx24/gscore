<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StatsController;
Route::get('/check-score', [ScoreController::class, 'checkScore']);
Route::get('/score-stats', [StatsController::class, 'scoreStats']);
Route::get('/hello', function () {
    return response()->json(['message' => 'Hello world']);
});