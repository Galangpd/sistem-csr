<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest.index');
});
Route::get('/login', function () {
    return view('auth.login');
});
