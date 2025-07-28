<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/{source}', [HomeController::class, 'redirect'])->name('redirect');
Route::get('/{source}/{category}', [HomeController::class, 'source'])->name('source');
Route::get('/{source}/{category}/{index}', [HomeController::class, 'post'])->name('post');
