<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::group(['middleware' => 'fullfield'], function () {
        Route::resource('/kecamatan', App\Http\Controllers\Backend\KecamatanController::class);
        Route::resource('/desa', App\Http\Controllers\Backend\DesaController::class);
        Route::resource('/kategori', App\Http\Controllers\Backend\KategoriController::class);
        Route::post('kategori-status/{id}', [App\Http\Controllers\Backend\KategoriController::class, 'status']);
        Route::get('dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('/operator', App\Http\Controllers\Backend\OperatorController::class);
        Route::post('operator-status/{id}', [App\Http\Controllers\Backend\OperatorController::class, 'status']);
        Route::resource('/aparatur', App\Http\Controllers\Backend\AparaturController::class);
        Route::post('aparatur-status/{id}', [App\Http\Controllers\Backend\AparaturController::class, 'status']);
        Route::resource('/paket', App\Http\Controllers\Backend\PaketController::class);
        Route::get('rupiah-terbilang', [App\Http\Controllers\Backend\PaketController::class, 'rupiahTerbilang']);
        Route::get('akk/{id}/edit', [App\Http\Controllers\Backend\PaketController::class, 'editAkk'])->name('akk.edit');
        Route::put('akk/{id}', [App\Http\Controllers\Backend\PaketController::class, 'updateAkk'])->name('akk.update');
        Route::get('hps/{id}/edit', [App\Http\Controllers\Backend\PaketController::class, 'editHps'])->name('hps.edit');
        Route::post('hps', [App\Http\Controllers\Backend\PaketController::class, 'storeHps']);
        Route::delete('hps/{id}', [App\Http\Controllers\Backend\PaketController::class, 'destroyHps'])->name('hps.destroy');
        Route::get('get-vendor', [App\Http\Controllers\Backend\PaketController::class, 'getVendor']);
        Route::get('undangan/{id}/edit', [App\Http\Controllers\Backend\UndanganController::class, 'editUndangan'])->name('undangan.edit');
        Route::put('undangan/{id}', [App\Http\Controllers\Backend\UndanganController::class, 'updateUndangan'])->name('undangan.update');
        Route::post('add-vendor', [App\Http\Controllers\Backend\UndanganController::class, 'addVendor']);
        Route::delete('delete-vendor/{id}', [App\Http\Controllers\Backend\UndanganController::class, 'destroyVendor']);
        Route::post('add-material', [App\Http\Controllers\Backend\UndanganController::class, 'addMaterial']);
        Route::delete('delete-material/{id}', [App\Http\Controllers\Backend\UndanganController::class, 'destroyMaterial']);
        Route::get('evaluasi-penawaran/{id}', [App\Http\Controllers\Backend\StepDuaController::class, 'evaluasiPenawaran'])->name('evaluasi-penawaran.edit');
        Route::put('evaluasi-penawaran/{id}', [App\Http\Controllers\Backend\StepDuaController::class, 'evaluasiPenawaranUpdate'])->name('evaluasi-penawaran.update');
        Route::get('hasil-evaluasi-penawaran/{id}', [App\Http\Controllers\Backend\StepDuaController::class, 'hasilEvaluasiPenawaran'])->name('hasil-evaluasi-penawaran.edit');
        Route::post('hasil-evaluasi-penawaran', [App\Http\Controllers\Backend\StepDuaController::class, 'hasilEvaluasiPenawaranStore'])->name('hasil-evaluasi-penawaran.store');
        Route::delete('hasil-evaluasi-penawaran/{id}', [App\Http\Controllers\Backend\StepDuaController::class, 'hasilEvaluasiPenawaranDestroy']);
        Route::post('hasil-evaluasi-penawaran/{id}', [App\Http\Controllers\Backend\StepDuaController::class, 'hasilEvaluasiPenawaranField'])->name('hasil-evaluasi-penawaran.field');
        Route::get('nego-harga/{id}', [App\Http\Controllers\Backend\StepDuaController::class, 'negoHarga'])->name('nego-harga.edit');
        Route::put('nego-harga/{id}', [App\Http\Controllers\Backend\StepDuaController::class, 'negoHargaUpdate'])->name('nego-harga.update');
        Route::get('surat-perjanjian/{id}', [App\Http\Controllers\Backend\StepDuaController::class, 'suratPerjanjian'])->name('surat-perjanjian.edit');
        Route::put('surat-perjanjian/{id}', [App\Http\Controllers\Backend\StepDuaController::class, 'suratPerjanjianUpdate'])->name('surat-perjanjian.update');
        Route::get('cetak-undangan/{id}', [App\Http\Controllers\Backend\PrintController::class, 'cetakUndangan'])->name('cetak-undangan');
        Route::get('print-undangan', [App\Http\Controllers\Backend\PrintController::class, 'printUndangan'])->name('print-undangan');
        Route::get('print-step-pertama/{id}', [App\Http\Controllers\Backend\PrintController::class, 'printStepPertama'])->name('print-step-pertama');
        Route::get('print-kak/{id}', [App\Http\Controllers\Backend\PrintController::class, 'printKak'])->name('print-kak');
        Route::get('print-hps/{id}', [App\Http\Controllers\Backend\PrintController::class, 'printHps'])->name('print-hps');
        Route::get('print-step-kedua/{id}', [App\Http\Controllers\Backend\PrintController::class, 'printStepKedua'])->name('print-step-kedua');
        Route::get('/notifikasi/{id}', [App\Http\Controllers\Backend\NotifikasiController::class, 'readNotification'])->name('read.notif');
        Route::get('/undangan-paket', [App\Http\Controllers\Backend\UndanganPaketController::class, 'undangan'])->name('undangan.paket');
        Route::get('/undangan-paket-show/{id}', [App\Http\Controllers\Backend\UndanganPaketController::class, 'undanganShow'])->name('undangan.paket.show');
        Route::get('/undangan-paket-konfirmasi/{id}', [App\Http\Controllers\Backend\UndanganPaketController::class, 'undanganKonfirmasi'])->name('undangan.paket.konfirmasi');
        Route::post('/undangan-paket-konfirmasi/{id}', [App\Http\Controllers\Backend\UndanganPaketController::class, 'undanganKonfirmasiPost'])->name('undangan.paket.konfirmasi.post');
        Route::get('/paket-vendor', [App\Http\Controllers\Backend\PaketVendorController::class, 'index'])->name('paket-vendor.index');
        Route::get('/paket-vendor/{id}/show', [App\Http\Controllers\Backend\PaketVendorController::class, 'show'])->name('paket-vendor.show');
        Route::get('/paket-admin', [App\Http\Controllers\Backend\PaketAdminController::class, 'index'])->name('paket-admin.index');
        Route::get('/paket-admin/{id}/show', [App\Http\Controllers\Backend\PaketAdminController::class, 'show'])->name('paket-admin.show');        
    });
    Route::get('profile-vendor', [App\Http\Controllers\Backend\ProfileController::class, 'vendor'])->name('profile.vendor');
    Route::post('profile-vendor', [App\Http\Controllers\Backend\ProfileController::class, 'vendorPost'])->name('profile.vendor.post');
    Route::get('profile-desa', [App\Http\Controllers\Backend\ProfileController::class, 'desa'])->name('profile.desa');
    Route::post('profile-desa', [App\Http\Controllers\Backend\ProfileController::class, 'desaPost'])->name('profile.desa.post');
    Route::get('profile-akun', [App\Http\Controllers\Backend\ProfileController::class, 'akun'])->name('profile.akun');
    Route::post('profile-akun', [App\Http\Controllers\Backend\ProfileController::class, 'akunPost'])->name('profile.akun.post');
    Route::get('get-desa', [App\Http\Controllers\Backend\ProfileController::class, 'getDesa']);
});


Route::group(['as' => 'frontend.'], function () {
    Route::get('/', [App\Http\Controllers\Frontend\WelcomeController::class, 'index'])->name('welcome.index');
    Route::get('get-desa', [App\Http\Controllers\Frontend\WelcomeController::class, 'getDesa']);
    Route::get('show/{id}', [App\Http\Controllers\Frontend\WelcomeController::class, 'show'])->name('welcome.show');
    Route::get('/kontak-kami', [App\Http\Controllers\Frontend\WelcomeController::class, 'kontak'])->name('welcome.kontak');
    Route::resource('/register', App\Http\Controllers\Frontend\RegisterController::class);
    Route::get('login', [App\Http\Controllers\Frontend\LoginController::class, 'formLogin'])->name('login');
    Route::post('login', [App\Http\Controllers\Frontend\LoginController::class, 'login'])->name('login.post');
    Route::post('logout', [App\Http\Controllers\Frontend\LoginController::class, 'logout'])->name('logout');
    Route::get('/konfirmasi/{code}', [App\Http\Controllers\Frontend\RegisterController::class, 'verify'])->name('verify.code');
    Route::get('/konfirmasi-pendaftaran/{url}', [App\Http\Controllers\Frontend\RegisterController::class, 'confirm'])->name('confirm.email');
    Route::post('/konfirmasi-pendaftaran/{url}', [App\Http\Controllers\Frontend\RegisterController::class, 'confirmPost'])->name('confirm.email.post');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
