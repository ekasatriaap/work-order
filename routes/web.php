<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanPetugasController;
use App\Http\Controllers\LaporanWorkOrderController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\PenugasanDetailController;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\TugasDetailController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::resource('user', UserController::class)->except(["show"]);

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

    Route::resource("produk", ProdukController::class)->except(["show"]);

    Route::resource("penugasan", PenugasanController::class);
    Route::resource('penugasan-detail', PenugasanDetailController::class)->except(['index']);

    Route::resource("tugas", TugasController::class)->only(["index", "edit", "update", "show"]);
    Route::resource("tugas-detail", TugasDetailController::class)->only(["edit", "update", "show"]);

    Route::prefix("laporan/work-order")->controller(LaporanWorkOrderController::class)->group(function () {
        Route::get("/", "index")->name("laporan-work-order.index");
        Route::post("/cetak", "cetak")->name("laporan-work-order.cetak");
    });

    Route::prefix("laporan/petugas")->controller(LaporanPetugasController::class)->group(function () {
        Route::get("/", "index")->name("laporan-petugas.index");
        Route::post("/cetak", "cetak")->name("laporan-petugas.cetak");
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
