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

Route::get('/register-perusahaan', function () {
    return view('auth.registerPerusahaan');
});
Route::get('/register-masyarakat', function () {
    return view('auth.registerMasyarakat');
});

Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/login', [AuthenticationController::class, 'login'])->name('auth.login');

Route::get('/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');