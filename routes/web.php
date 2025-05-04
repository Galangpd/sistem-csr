<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest.index');
});
Route::get('/pilih-pengguna', function () {
    return view('guest.pilihpengguna');
});
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register-perusahaan', function () {
    return view('auth.registerPerusahaan');
});
Route::get('/register-masyarakat', function () {
    return view('auth.registerMasyarakat');
});
