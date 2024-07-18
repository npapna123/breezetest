<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/landing', 'landing');
Route::view('/post', 'post');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
    Route::view('movie', 'movie')->name('movie');
    Route::view('chat', 'chat')->name('chat');
    Route::view('alpine', 'alpine')->name('alpine');
});

require __DIR__.'/auth.php';
