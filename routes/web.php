<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\CategoryController;


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/', [LetterController::class, 'index'])->name('letters.index');
Route::get('/letters/create', [LetterController::class, 'create'])->name('letters.create');
Route::post('/letters', [LetterController::class, 'store'])->name('letters.store');
Route::get('/letters/download/{id}', [LetterController::class, 'download'])->name('letters.download');

Route::get('/letters/{id}/edit', [LetterController::class, 'edit'])->name('letters.edit');
Route::put('/letters/{id}', [LetterController::class, 'update'])->name('letters.update');
Route::get('/letters/{id}', [LetterController::class, 'show'])->name('letters.show');
Route::delete('/letters/{id}', [LetterController::class, 'destroy'])->name('letters.destroy');

Route::view('/about', 'about')->name('about');