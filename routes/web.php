<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;

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


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');