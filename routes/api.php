<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\TopAController;
Route::get('/check-score', [ScoreController::class, 'checkScore']);
Route::get('/score-stats', [StatsController::class, 'scoreStats']);
Route::get('/top', [TopAController::class, 'topAStats']);
// Route::get('/hello', function () {
//     return response()->json(['message' => 'Hello world']);
// });