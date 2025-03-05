<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get("/users", "index")->name("users.index");
    });
    Route::controller(PeranController::class)->group(function () {
        Route::get("/roles", "index")->name("[peran].index");
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
