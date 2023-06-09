<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CetakLaporanController;
use App\Http\Controllers\CetakBukuController;
use App\Http\Controllers\CetakBukuDipinjamController;
use App\Http\Controllers\CetakBukuInstockController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\RiwayatPinjamController;
use App\Http\Controllers\ReportBukuController;
use App\Http\Controllers\ShowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ShowController::class,'index','show']);
Auth::routes([
    'verify' => true
]);
Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified');

    Route::resource('kategori', KategoriController::class);

    Route::resource('buku', BukuController::class);

    Route::get('/reportbuku', [App\Http\Controllers\ReportBukuController::class, 'index'])->name('buku.report');

    Route::get('/reportbuku/dipinjam', [App\Http\Controllers\ReportBukuController::class, 'dipinjam'])->name('buku.laporanbukudipinjam');

    Route::get('/reportbuku/instock', [App\Http\Controllers\ReportBukuController::class, 'instock'])->name('buku.laporanbukuinstock');

    Route::resource('anggota', AnggotaController::class);

    Route::resource('profile', ProfileController::class)->only('index','update','edit');

    Route::resource('peminjaman', RiwayatPinjamController::class);

    Route::get('/cetaklaporan', CetakLaporanController::class);

    Route::get('/cetakbuku', CetakBukuController::class);

    Route::get('/cetakbukudipinjam', CetakBukuDipinjamController::class);

    Route::get('/cetakbukuinstock', CetakBukuInstockController::class);

    Route::get('/pengembalian', [PengembalianController::class,'index']);

    Route::post('/pengembalian', [PengembalianController::class,'pengembalian']);

});
