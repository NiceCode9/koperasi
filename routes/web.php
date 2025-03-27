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
Route::view('/survei', 'form-pengajuan')->name('simulasi.murabahah');

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
    Route::middleware('checkrole:admin')->prefix('administrator')->name('admin.')->group(function () {
        Route::resources([
            'users' => UserController::class,
            'nasabah' => NasabahController::class,
        ]);
        Route::patch('users/{user}/status', [UserController::class, 'updateStatus'])->name('users.status');
    });

    // Role Nasabah
    Route::middleware('checkrole:nasabah')->name('nasabah.')->prefix('nasabah')->group(function () {
        Route::get('/profile', [App\Http\Controllers\NasabahProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [App\Http\Controllers\NasabahProfileController::class, 'update'])->name('profile.update');
    });
});
