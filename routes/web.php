<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return view('guest.index');
});
Route::get('/pilih-pengguna', function () {
    return view('guest.pilihpengguna');
});

Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');

Route::get('/registerPerusahaan', [AuthenticationController::class, 'showRegisterPerusahaan'])->name('auth.register-perusahaan');
Route::get('/registerMasyarakat', [AuthenticationController::class, 'showRegisterMasyarakat'])->name('auth.register-masyarakat');

Route::post('/registerMasyarakat', [AuthenticationController::class, 'registerMasyarakat'])->name('register.masyarakat');
Route::post('/registerPerusahaan', [AuthenticationController::class, 'registerPerusahaan'])->name('register.perusahaan');

Route::middleware('role:masyarakat')->group(function () {
    Route::get('/dashboard/masyarakat', [MasyarakatController::class, 'index'])->name('dashboard.masyarakat');
    Route::get('/setting/masyarakat', [SettingController::class, 'index'])->name('setting.masyarakat');
    Route::put('/setting/masyarakat/profile', [MasyarakatController::class, 'updateProfile'])->name('update.setting.masyarakat');
    Route::put('/setting/masyarakat/user', [SettingController::class, 'updateUser'])->name('update.user.masyarakat');
});

Route::middleware('role:perusahaan')->group(function () {
    Route::get('/dashboard/perusahaan', [PerusahaanController::class, 'index'])->name('dashboard.perusahaan');
    Route::get('/setting/perusahaan', [SettingController::class, 'index'])->name('setting.perusahaan');
    Route::put('/setting/perusahaan/profile', [PerusahaanController::class, 'updateProfile'])->name('update.setting.perusahaan');
    Route::put('/setting/perusahaan/user', [SettingController::class, 'updateUser'])->name('update.user.perusahaan');
});