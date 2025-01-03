<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/categories/create',[CategoryController::class,'create']);
Route::post('/categories/store',[CategoryController::class, 'store'])->name('store');
Route::get('/categories/show',[CategoryController::class,'index'])->name('show');
Route::post('/categories/delete',[CategoryController::class, 'delete'])->name('delete');
Route::put('/categories/update', [CategoryController::class, 'update'])->name('update');