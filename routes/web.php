<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\AuthenticationController;

Route::get('/', function () {
    return view('guest.index');
});
Route::get('/pilih-pengguna', function () {
    return view('guest.pilihpengguna');
});

Route::get('/admin', [AdminController::class, 'showLogin'])->name('login');
Route::post('/admin', [AdminController::class, 'login'])->name('admin.login');

Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');
Route::get('/resetPassword', [AuthenticationController::class, 'resetPassword'])->name('auth.resetPassword');
Route::post('/forgot-password', [AuthenticationController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthenticationController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthenticationController::class, 'reset'])->name('password.update');

Route::get('/registerPerusahaan', [AuthenticationController::class, 'showRegisterPerusahaan'])->name('auth.register-perusahaan');
Route::get('/registerMasyarakat', [AuthenticationController::class, 'showRegisterMasyarakat'])->name('auth.register-masyarakat');

Route::post('/registerMasyarakat', [AuthenticationController::class, 'registerMasyarakat'])->name('register.masyarakat');
Route::post('/registerPerusahaan', [AuthenticationController::class, 'registerPerusahaan'])->name('register.perusahaan');

Route::get('/get-kabupaten/{provinsiId}', [LokasiController::class, 'getKabupaten']);
Route::get('/get-kecamatan/{kabupatenId}', [LokasiController::class, 'getKecamatan']);
Route::get('/get-kalurahan/{kecamatanId}', [LokasiController::class, 'getKalurahan']);

Route::middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::get('/dashboard/masyarakat', [MasyarakatController::class, 'index'])->name('dashboard.masyarakat');
    Route::get('/setting/masyarakat', [SettingController::class, 'masyarakat'])->name('setting.masyarakat');
    Route::put('/setting/masyarakat/profile', [MasyarakatController::class, 'updateProfile'])->name('update.setting.masyarakat');
    Route::put('/setting/masyarakat/user', [SettingController::class, 'updateUser'])->name('update.user.masyarakat');
    Route::get('/dashboard/masyarakat/detail/{id}', [MasyarakatController::class, 'detailPerusahaan'])->name('detail.perusahaan');
});

Route::middleware(['auth','role:perusahaan'])->group(function () {
    Route::get('/dashboard/perusahaan', [PerusahaanController::class, 'index'])->name('dashboard.perusahaan');
    Route::get('/dashboard/perusahaan/penilaian', [PerusahaanController::class, 'showPenilaian'])->name('penilaian.perusahaan');
    Route::get('/dashboard/perusahaan/edit-penilaian', [PerusahaanController::class, 'editPenilaian'])->name('editPenilaian.perusahaan');
    Route::post('/dashboard/perusahaan/penilaian', [PerusahaanController::class, 'storePreference'])->name('store.penilaian.perusahaan');
    Route::put('/dashboard/perusahaan/penilaian', [PerusahaanController::class, 'updatePreference'])->name('update.penilaian.perusahaan');
    Route::get('/setting/perusahaan', [SettingController::class, 'perusahaan'])->name('setting.perusahaan');
    Route::put('/setting/perusahaan/profile', [PerusahaanController::class, 'updateProfile'])->name('update.setting.perusahaan');
    Route::put('/setting/perusahaan/user', [SettingController::class, 'updateUser'])->name('update.user.perusahaan');
    Route::get('/dashboard/perusahaan/detail/{id}', [PerusahaanController::class, 'detailMasyarakat'])->name('detail.masyarakat');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/admin/register-perusahaan', [AdminController::class, 'pendaftaranPerusahaan'])->name('register.perusahaan.admin');
    Route::get('/admin/register-masyarakat', [AdminController::class, 'pendaftaranMasyarakat'])->name('register.masyarakat.admin');
    Route::post('/admin/approve/{id}', [AdminController::class, 'approveUser'])->name('admin.approve');
    Route::post('/admin/reject/{id}', [AdminController::class, 'rejectUser'])->name('admin.reject');
    Route::get('/admin/perusahaan', [AdminController::class, 'perusahaan'])->name('perusahaan.admin');
    Route::get('/admin/perusahaan/{id}', [AdminController::class, 'detailPerusahaan'])->name('detail.perusahaan.admin');
    Route::get('/admin/masyarakat', [AdminController::class, 'masyarakat'])->name('masyarakat.admin');
    Route::get('/admin/masyarakat/{id}', [AdminController::class, 'detailMasyarakat'])->name('detail.masyarakat.admin');
    Route::get('/admin/kriteria', [AdminController::class, 'kriteria'])->name('kriteria.admin');
    Route::get('/admin/kriteria/bidang-usaha', [AdminController::class, 'bidangUsaha'])->name('bidangUsaha.kriteria.admin');
    Route::post('/admin/kriteria/bidang-usaha', [AdminController::class, 'tambahBidang'])->name('create.bidangUsaha.admin');
    Route::put('/admin/kriteria/bidang-usaha/{id}', [AdminController::class, 'updateBidang'])->name('update.bidangUsaha.admin');
    Route::get('/admin/kriteria/jenis-bantuan', [AdminController::class, 'jenisBantuan'])->name('jenisBantuan.kriteria.admin');
    Route::post('/admin/kriteria/jenis-bantuan', [AdminController::class, 'tambahBantuan'])->name('create.jenisBantuan.admin');
    Route::put('/admin/kriteria/jenis-bantuan/{id}', [AdminController::class, 'updateBantuan'])->name('update.jenisBantuan.admin');
});