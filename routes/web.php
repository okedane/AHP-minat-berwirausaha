<?php

use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PerbadinganKriteriaController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\SkalaPenilaianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\ManagementAkunController;
use App\Http\Controllers\User\KuesionerController;
use App\Http\Controllers\KlasifikasiPenilaianController;
use App\Http\Controllers\UsahaController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('login-proses', [AuthController::class, 'login_proses'])->name('login-proses');

    Route::get('forgot', [AuthController::class, 'forgot'])->name('forgot');
    Route::post('forgot-proses', [AuthController::class, 'forgot_proses'])->name('forgot-proses');
    Route::get('verify-code', [AuthController::class, 'verify_code'])->name('verify-code');
    Route::post('verify-code-proses', [AuthController::class, 'verify_code_proses'])->name('verify-code-proses');
    Route::get('reset-password', [AuthController::class, 'reset_password'])->name('reset-password');
    Route::post('reset-password-proses', [AuthController::class, 'reset_password_proses'])->name('reset-password-proses');
});


Route::middleware(['auth', 'role:ahli'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('ahli.dashboard');

    Route::prefix('kriteria')->group(function () {
        Route::get('/', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::post('/', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::put('/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::delete('/{id}', [KriteriaController::class, 'delete'])->name('kriteria.delete');
        Route::get('/matriks', [PerbadinganKriteriaController::class, 'index'])->name('kriteria.matriks.index');
        Route::post('/matriks', [PerbadinganKriteriaController::class, 'store'])->name('kriteria.matriks.store');
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

    Route::prefix('klasifikasi-penilaian')->group(function () {
        Route::get('/', [KlasifikasiPenilaianController::class, 'index'])->name('klasifikasi-penilaian.index');
        Route::post('/', [KlasifikasiPenilaianController::class, 'store'])->name('klasifikasi-penilaian.store');
        Route::put('/{klasifikasiPenilaian}', [KlasifikasiPenilaianController::class, 'update'])->name('klasifikasi-penilaian.update');
        Route::delete('/{klasifikasiPenilaian}', [KlasifikasiPenilaianController::class, 'destroy'])->name('klasifikasi-penilaian.destroy');
    });


    Route::prefix('usaha')->group(function () {
        Route::get('/{id}', [UsahaController::class, 'index'])->name('usaha.index');
        Route::post('/', [UsahaController::class, 'store'])->name('usaha.store');
        Route::put('/{usaha}', [UsahaController::class, 'update'])->name('usaha.update');
        Route::delete('/{usaha}', [UsahaController::class, 'destroy'])->name('usaha.destroy');
    });


    Route::prefix('rekap')->group(function () {
        Route::get('/', [RekapController::class, 'index'])->name('rekap.index');
        Route::get('/{id}', [RekapController::class, 'show'])->name('rekap.show');
    });
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::prefix('management-akun')->group(function () {
        Route::get('/admin', [ManagementAkunController::class, 'admin'])->name('admin.index');
        Route::get('/user', [ManagementAkunController::class, 'user'])->name('user.index');
        Route::get('/ahli', [ManagementAkunController::class, 'ahli'])->name('ahli.index');
        Route::post('/', [ManagementAkunController::class, 'store'])->name('management-akun.store');
        Route::put('/{id}', [ManagementAkunController::class, 'update'])->name('management-akun.update');
        Route::delete('/{id}', [ManagementAkunController::class, 'destroy'])->name('management-akun.destroy');
    });
});

Route::prefix('user')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/user/password/update', [ProfileController::class, 'update'])->name('user.password.update');
    Route::get('/kuesioner', [KuesionerController::class, 'kuesioner'])->name('user.kuesioner');
    Route::post('/kuesioner', [KuesionerController::class, 'store'])->name('user.kuesioner.store');
    Route::get('/hasil', [KuesionerController::class, 'hasil'])->name('user.hasil');
    Route::get('/hasil/{id}', [KuesionerController::class, 'hasil'])->name('user.hasil.show');
    Route::get('/rekap', [KuesionerController::class, 'rekap'])->name('user.rekap');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/admin/password', [DashboardController::class, 'showChangePassword'])->name('admin.password.form');
    Route::post('/admin/password', [DashboardController::class, 'updatePassword'])->name('admin.password.update');
});
