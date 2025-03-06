<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::resource('user', UserController::class)->names([
        'index' => 'user.index',
        'create' => 'user.create',
        'store' => 'user.store',
        'edit' => 'user.edit',
        'update' => 'user.update',
        'destroy' => 'user.destroy',
    ])->except(["show"]);

    Route::prefix("role")->controller(RoleController::class)->group(function () {
        Route::get("/", "index")->name("role.index");
        Route::get("/create", "create")->name("role.create");
        Route::post("/", "store")->name("role.store");
        Route::get("/{id}/edit", "edit")->name("role.edit");
        Route::put("/{id}", "update")->name("role.update");
        Route::get("/{id}/show", "show")->name("role.show");
        Route::delete("/{id}", "destroy")->name("role.destroy");
        Route::post('/{id}/permission', 'permission')->name('role.permission');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
