<?php
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PerbadinganKriteriaController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\SkalaPenilaianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RekapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');


Route::prefix('kriteria')->group(function () {
    Route::get('/', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::post('/', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::put('/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('/{id}', [KriteriaController::class, 'delete'])->name('kriteria.delete');
}); 

Route::prefix('kriteria')->group(function () {
    Route::get('/matriks', [PerbadinganKriteriaController::class, 'index'])
        ->name('kriteria.matriks.index');
    Route::post('/matriks', [PerbadinganKriteriaController::class, 'store'])
        ->name('kriteria.matriks.store');
});


Route::prefix('pertanyaan')->group(function () {
    Route::get('/', [PertanyaanController::class, 'index'])->name('pertanyaan.index');
    Route::post('/', [PertanyaanController::class, 'store'])->name('pertanyaan.store');
    Route::put('/{id}', [PertanyaanController::class, 'update'])->name('pertanyaan.update');
    Route::delete('/{id}', [PertanyaanController::class, 'delete'])->name('pertanyaan.delete');
});


Route::prefix('skala-penilaian')->group(function () {
    Route::get('/{id}', [SkalaPenilaianController::class, 'index'])->name('skala-penilaian.index');
    Route::post('/', [SkalaPenilaianController::class, 'store'])->name('skala-penilaian.store');
    Route::put('/{id}', [SkalaPenilaianController::class, 'update'])->name('skala-penilaian.update');
    Route::delete('/{id}', [SkalaPenilaianController::class, 'delete'])->name('skala-penilaian.delete');
}); 


Route::prefix('rekap')->group(function () {
    Route::get('/', [RekapController::class, 'index'])->name('rekap.index');
}); 



