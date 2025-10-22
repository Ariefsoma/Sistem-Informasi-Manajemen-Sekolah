<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::view('/profil', 'public.profil')->name('profil');
Route::view('/berita', 'public.berita')->name('berita');
Route::view('/kontak', 'public.kontak')->name('kontak');

Route::middleware(['auth','is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('user-links', [\App\Http\Controllers\Admin\UserLinkController::class, 'index'])->name('user-links.index');
    Route::post('user-links', [\App\Http\Controllers\Admin\UserLinkController::class, 'update'])->name('user-links.update');
    Route::post('user-links/unmap', [\App\Http\Controllers\Admin\UserLinkController::class, 'unmap'])->name('user-links.unmap');
    Route::post('user-links/create-parent', [\App\Http\Controllers\Admin\UserLinkController::class, 'createParent'])->name('user-links.create-parent');
    // Admin user role management
    Route::get('user-roles', [\App\Http\Controllers\Admin\UserRoleController::class, 'index'])->name('user-roles.index');
    Route::post('user-roles', [\App\Http\Controllers\Admin\UserRoleController::class, 'update'])->name('user-roles.update');
    // Admin resource routes
    Route::resource('siswa', App\Http\Controllers\SiswaController::class);
    Route::resource('guru', App\Http\Controllers\GuruController::class);
    Route::resource('matapelajaran', App\Http\Controllers\MataPelajaranController::class);
    Route::resource('pengumuman', App\Http\Controllers\PengumumanController::class);
    Route::resource('pembayaran', App\Http\Controllers\PembayaranController::class);
    Route::resource('inventaris', App\Http\Controllers\InventarisController::class);
    Route::resource('surat', App\Http\Controllers\SuratController::class);
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Student dashboard
    Route::get('/student/dashboard', [App\Http\Controllers\StudentDashboardController::class, 'index'])->name('student.dashboard');
    // Guru routes (simple)
    Route::middleware('role:guru')->prefix('guru')->name('guru.')->group(function () {
        Route::get('nilai', [App\Http\Controllers\NilaiController::class, 'index'])->name('nilai.index');
        Route::get('absensi', [App\Http\Controllers\AbsensiController::class, 'index'])->name('absensi.index');
        Route::get('absensi/bulk', [App\Http\Controllers\AbsensiController::class, 'create'])->name('absensi.create');
        Route::post('absensi/bulk', [App\Http\Controllers\AbsensiController::class, 'storeBulk'])->name('absensi.storeBulk');
    });

    // Siswa routes
    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('dashboard', function () { return view('dashboard'); })->name('dashboard');
    });
});

require __DIR__.'/auth.php';
