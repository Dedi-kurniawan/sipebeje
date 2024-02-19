<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/master'], function () {
    Route::post('kecamatan', [App\Http\Controllers\DataTable\MasterController::class, 'kecamatan']);
    Route::post('desa', [App\Http\Controllers\DataTable\MasterController::class, 'desa']);
    Route::post('kategori', [App\Http\Controllers\DataTable\MasterController::class, 'kategori']);
    Route::post('satuan', [App\Http\Controllers\DataTable\MasterController::class, 'satuan']);
    Route::post('operator', [App\Http\Controllers\DataTable\MasterController::class, 'operator']);
    Route::post('aparatur', [App\Http\Controllers\DataTable\MasterController::class, 'aparatur']);
    Route::post('vendor', [App\Http\Controllers\DataTable\MasterController::class, 'vendor']);
    Route::post('paket', [App\Http\Controllers\DataTable\PaketController::class, 'paket']);
    Route::post('hps', [App\Http\Controllers\DataTable\PaketController::class, 'hps']);
    Route::post('undangan-vendor', [App\Http\Controllers\DataTable\PaketController::class, 'undanganVendor']);
    Route::post('undangan-material', [App\Http\Controllers\DataTable\PaketController::class, 'undanganMaterial']);
    Route::post('hasil-evaluasi-penawaran', [App\Http\Controllers\DataTable\PaketController::class, 'hasilEvaluasiPenawaran']);
    Route::post('cetak-undangan', [App\Http\Controllers\DataTable\PaketController::class, 'cetakUndangan']);
    Route::post('undangan-paket', [App\Http\Controllers\DataTable\VendorController::class, 'undangan']);
    Route::post('paket-vendor', [App\Http\Controllers\DataTable\VendorController::class, 'paket']);
    Route::post('paket-admin', [App\Http\Controllers\DataTable\AdminController::class, 'paket']);
    Route::post('surat-pesanan', [App\Http\Controllers\DataTable\AdminController::class, 'suratPesanan']);
    Route::post('surat-pesanan-detail', [App\Http\Controllers\DataTable\AdminController::class, 'suratPesananDetail']);
    Route::post('ba-barang', [App\Http\Controllers\DataTable\AdminController::class, 'baBarang']);
    Route::post('ba-barang-detail', [App\Http\Controllers\DataTable\AdminController::class, 'baBarangDetail']);
    Route::post('ba-pekerjaan', [App\Http\Controllers\DataTable\AdminController::class, 'baPekerjaan']);
    Route::post('ba-pekerjaan-detail', [App\Http\Controllers\DataTable\AdminController::class, 'baPekerjaanDetail']);
    Route::post('hps-ba-nego-harga', [App\Http\Controllers\DataTable\PaketController::class, 'hpsBaNego']);
});
