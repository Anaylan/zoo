<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\CageController::class, 'index']);


Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::resource('/animals', App\Http\Controllers\AnimalController::class);
Route::resource('/cages', App\Http\Controllers\CageController::class);
