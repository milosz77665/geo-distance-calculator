<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DistanceController;

Route::get('/', function () {
    return Inertia::render('DistanceCalculator');
})->name('home');

Route::post('/', [DistanceController::class, 'calculate'])->name('calculate');
