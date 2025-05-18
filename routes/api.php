<?php
use App\Http\Controllers\ScoreController;

Route::get('/check-score', [ScoreController::class, 'checkScore']);
