<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::resource('/', App\Http\Controllers\TaskController::class)->only('index', 'store');

Route::group(['middleware' => ['auth', 'verifyAdmin']], function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
});
