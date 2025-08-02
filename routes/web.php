<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return Inertia::render('HomeMainSection');
})->name('home');

Route::get('clientLogin', function () {
    return Inertia::render('auth/Login');
})->name('clientLogin'); 

Route::get('clientRegistration', function () {
    return Inertia::render('auth/Register'); 
})->name('clientRegistration');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
