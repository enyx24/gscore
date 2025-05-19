<?php

use Illuminate\Support\Facades\Route;

// Route::get('/test', function () {
//     return 'Test route working!';
// });
Route::get('/', function () {
    return view('dashboard');
});
Route::get('/check', fn () => view('check'));
Route::get('/report', fn () => view('report'));
Route::get('/settings', fn () => view('settings'));
// Route::get('/top-a', fn () => view('top_a'));