<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OilChangeController;

Route::get('/', [OilChangeController::class, 'create'])->name('oil-change.create');
Route::post('/check', [OilChangeController::class, 'store'])->name('oil-change.store');
Route::get('/result/{check}', [OilChangeController::class, 'show'])->name('oil-change.show');
