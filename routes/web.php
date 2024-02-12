<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\FarmasiKonsumsiController;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\AntrolController;
// use App\Repositories\PoliklinikController;

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

Route::get('/', function () {
    return view('halamanutama');
});
// Master Barang
Route::get('/masterbarang', function () {
    return view('500');
});
// Route::get('/masterbarang', [MasterBarangController::class, 'index']);
// Route::get('/masterbarang_add', [MasterBarangController::class, 'create']);
// Route::post('/masterbarang_store', [MasterBarangController::class, 'store'])->name('masterbarang_store');
// Route::get('/masterbarang/edit/{id}', [MasterBarangController::class, 'edit'])->name('edit');
// Route::post('/masterbarang_update', [MasterBarangController::class, 'update'])->name('masterbarang_update');

// Permintaan
Route::get('/permintaan', [PermintaanController::class, 'index'])->name('permintaan.index');
//
Route::get('/permintaan_add', [PermintaanController::class, 'create'])->name('permintaan.add');;
Route::post('/permintaan_show', [PermintaanController::class, 'show'])->name('permintaan_show');
//Route::get('/permintaan_store', [PermintaanController::class, 'store'])->name('permintaan_store');
Route::post('/permintaan_store', [PermintaanController::class, 'store'])->name('permintaan_store');
Route::get('/permintaan/print/{id}', [PermintaanController::class, 'print'])->name('print');

//Laporan Permintaan
//Route::get('/laporan', [PermintaanController::class, 'laporan']);
Route::match(['get', 'post'], '/laporan', [PermintaanController::class, 'laporan'])->name('permintaan.laporan');
Route::get('/laporan/detail/{id}/{bulan}/{tahun}', [PermintaanController::class, 'detail'])->name('detail');

Route::get('/farmasi/konsumsi', [FarmasiKonsumsiController::class, 'index'])->name('farmasi.konsumsi.index');
// Route::post('/farmasi/konsumsi/simpan', [FarmasiKonsumsiController::class, 'simpan'])->name('farmasi.konsumsi.simpan');
// Route::post('/farmasi/konsumsi/uploadexcel', [FarmasiKonsumsiController::class, 'uploadExcel'])->name('farmasi.konsumsi.upload.excel');
Route::get('/farmasi/datatables', [FarmasiKonsumsiController::class, 'indexAjax'])->name('farmasi.datatables');
Route::post('/farmasi/generateResep', [FarmasiKonsumsiController::class, 'generateResep'])->name('farmasi.generateResep');
Route::post('/farmasi/generateSubResep', [FarmasiKonsumsiController::class, 'generateSubResep'])->name('farmasi.generateSubResep');
Route::post('/farmasi/generateBiayaEkse', [FarmasiKonsumsiController::class, 'generateBiayaEkse'])->name('farmasi.generateBiayaEkse');
Route::post('/farmasi/generateBiayaJKN', [FarmasiKonsumsiController::class, 'generateBiayaJKN'])->name('farmasi.generateBiayaJKN');


// Poliklinik
Route::get('/poliklinik/antrian', [PoliklinikController::class, 'antrian'])->name('poliklinik.antrian.poli');
Route::get('/poliklinik/cetak', [PoliklinikController::class, 'cetak'])->name('poliklinik.antrian.cetak');

// BPJS
// Update Waktu
Route::get('/antrol/index', [AntrolController::class, 'index'])->name('antrol.index');
Route::get('/antrol/datatables', [AntrolController::class, 'indexAjax'])->name('antrol.datatables');