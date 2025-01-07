<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/categories/create',[CategoryController::class,'create']);
Route::post('/categories/store',[CategoryController::class, 'store'])->name('store');
Route::get('/categories/show',[CategoryController::class,'index'])->name('show');
Route::post('/categories/delete',[CategoryController::class, 'delete'])->name('delete');
Route::put('/categories/update', [CategoryController::class, 'update'])->name('update');
