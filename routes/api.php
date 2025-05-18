<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;
Route::get('/check-score', [ScoreController::class, 'checkScore']);
Route::get('/hello', function () {
    return response()->json(['message' => 'Hello world']);
});