<?php

use App\Http\Controllers\Admin\AudioController;
use App\Http\Controllers\Admin\KoleksiController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\PermintaanController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController; // Added this line
use Illuminate\Support\Facades\Route;

// Landing Page Controller
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/tentang-kami', [LandingController::class, 'about'])->name('landing.about');
Route::get('/panduan', [LandingController::class, 'guide'])->name('landing.guide');

// Auth Controller
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Admin Dashboard Controller
Route::prefix('admin')->middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/guide-admin', [AdminDashboardController::class, 'guideAdmin'])->name('admin.guide');
    Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('admin.profile');
    
    // Kelola Data Koleksi
    Route::resource('koleksi', KoleksiController::class)->names('admin.koleksi');
    Route::get('/show/koleksi/import', [KoleksiController::class, 'showImport'])->name('admin.koleksi.show.import');
    Route::post('/store/koleksi/import', [KoleksiController::class, 'storeImport'])->name('admin.koleksi.store.import');
    
    // Data Audio
    Route::resource('audio', AudioController::class)->names('admin.audio');
    Route::get('/audio/create/{collectionId}', [AudioController::class, 'create'])->name('admin.audio.create');
    Route::post('/audio/test-tts', [AudioController::class, 'testTTS'])->name('admin.audio.testTTS');

    // Data Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa');

    // Permintaan Full Akses
    Route::get('/permintaan', [PermintaanController::class, 'index'])->name('admin.permintaan');
});