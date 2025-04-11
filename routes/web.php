<?php

use App\Http\Controllers\Admin\NasabahController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Nasabah\PengajuanController;

// layanan
Route::get('/pembiayaan-murabahah', function () {
    return view('layanan.layanan1');
});
Route::get('/simpanan-amanah', function () {
    return view('layanan.layanan2');
});
Route::get('/simpanan-umroh-dan-haji', function () {
    return view('layanan.layanan3');
});
Route::get('/simpanan-wadiah', function () {
    return view('layanan.layanan4');
});

// profil
Route::get('/profil', [PegawaiController::class, 'tampil'])->name('profil');

// home
Route::get('/', [HomeController::class, 'index'])->name('home');

// simulasi
Route::get('/simulasi', [HomeController::class, 'simulasi'])->name('simulasi');
Route::view('/survei', 'marketing.form-survei')->name('simulasi.murabahah');

// news
Route::get('/news', [NewsController::class, 'tampil'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

// login dan logout
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    // Role Admin
    Route::middleware('checkrole:admin,manajer')->prefix('administrator')->name('admin.')->group(function () {
        Route::resources([
            'users' => UserController::class,
            'nasabah' => NasabahController::class,
        ]);
        Route::patch('users/{user}/status', [UserController::class, 'updateStatus'])->name('users.status');

        // Manage Pengajuan
        Route::get('/pengajuan', [App\Http\Controllers\Nasabah\PengajuanController::class, 'index'])->name('pengajuan.index');
        Route::get('/pengajuan/{pengajuan}/verifikasi', [App\Http\Controllers\Nasabah\PengajuanController::class, 'verifikasi'])->name('pengajuan.verifikasi');
        Route::get('/pengajuan/{pengajuan}/hasil-survei', [App\Http\Controllers\Nasabah\PengajuanController::class, 'hasilSurvei'])->name('pengajuan.hasil-survei');
    });

    // Role Nasabah
    Route::middleware('checkrole:nasabah')->name('nasabah.')->prefix('nasabah')->group(function () {
        Route::get('/profile', [App\Http\Controllers\NasabahProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [App\Http\Controllers\NasabahProfileController::class, 'update'])->name('profile.update');

        // Pengajuan
        Route::controller(PengajuanController::class)->prefix('pengajuan')->name('pengajuan.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/form', 'form')->name('form');
            Route::get('/form/{pengajuan}', 'form')->name('form.edit');
            Route::post('/store', 'store')->name('store');
            Route::put('/{pengajuan}', 'update')->name('update');
            Route::delete('/{pengajuan}', 'destroy')->name('destroy');
        });
    });

    // Role Marketing
    Route::middleware('checkrole:marketing')->name('marketing.')->name('marketing.')->prefix('marketing')->group(function () {
        Route::get('/pengajuan', [App\Http\Controllers\MarketingController::class, 'pengajuan'])->name('pengajuan.survei.index');
        // Route::get('/pengajuan/{id/show}', [App\Http\Controllers\MarketingController::class, 'show'])->name('pengajuan.surevei.show');
        Route::get('/pengajuan/{id}/survei', [App\Http\Controllers\MarketingController::class, 'createSurvei'])->name('pengajuan.survei');
        Route::post('/pengajuan/store', [App\Http\Controllers\MarketingController::class, 'storeSurvei'])->name('pengajuan.survei.store');
        Route::get('/riwayat-survei', [App\Http\Controllers\MarketingController::class, 'riwayatSurvei'])->name('riwayat.survei');
        Route::get('/riwayat-survei/{id}/show', [App\Http\Controllers\MarketingController::class, 'showRiwayat'])->name('riwayat.survei.show');
        Route::get('/riwayat-survei/{id}/edit', [App\Http\Controllers\MarketingController::class, 'editSurvei'])->name('riwayat.survei.edit');
        Route::put('/riwayat-survei/{id}/update', [App\Http\Controllers\MarketingController::class, 'updateSurvei'])->name('riwayat.survei.update');
    });
});
