<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return 'Test route working!';
});
Route::get('/', function () {
    return view('dashboard');
});
Route::get('/check', fn () => view('check'));
Route::get('/stats', fn () => view('stats'));
Route::get('/top-a', fn () => view('top_a'));