<?php

use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\ClusteringController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Apps\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Apps\RekomendasiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Apps\PreferensiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/store', [AuthController::class, 'store'])->name('store.register');

Route::get('/preferensi', [PreferensiController::class, 'showForm'])->name('preferensi.form');
Route::post('/preferensi', [PreferensiController::class, 'simpanPreferensi'])->name('simpan.preferensi');

Route::prefix('admin')->middleware('auth', 'role:admin')->group(function () {
    // Route::view('/', 'pages.dashboard.index', ['menu' => 'dashboard'])->name('admin.dashboard');
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('buku')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('buku.index');
        Route::get('/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/store', [BukuController::class, 'store'])->name('buku.store');
        Route::get('/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::put('/update/{id}', [BukuController::class, 'update'])->name('buku.update');
        Route::delete('/delete/{id}', [BukuController::class, 'destroy'])->name('buku.delete');
    });

    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');
    });

    Route::prefix('clustering')->group(function () {
        Route::get('/', [ClusteringController::class, 'index'])->name('clustering.index');
        Route::get('/proses', [ClusteringController::class, 'clusterBuku'])->name('clustering.proses');
        Route::get('/hasil-cluster', [ClusteringController::class, 'hasilClustering'])->name('clustering.hasil');
    });
});

Route::prefix('user')->middleware('auth', 'role:user')->group(function () {
    // Rute untuk halaman utama pengguna
    Route::get('/', [HomeController::class, 'index'])->name('user.dashboard');
    Route::prefix('rekomendasi')->group(function () {
        Route::get('/', [RekomendasiController::class, 'index'])->name('user.rekomendasi.index');
        Route::post('/generate', [RekomendasiController::class, 'generate'])->name('user.rekomendasi.generate');
    });

    Route::prefix('detail-buku')->group(function () {
        Route::get('/{id}', [HomeController::class, 'detail'])->name('detail.buku');
    });

    // Rute untuk rekomendasi buku
});