<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenPembimbingController;
use App\Http\Controllers\KoorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenyeliaController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginPost');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('dashboardMahasiswa');
    Route::post('/update-mhs/{id}', [MahasiswaController::class, 'update'])->name('updateMhs');

    Route::get('/pengajuanKP', [MahasiswaController::class, 'pengajuan_kp'])->name('halamanPengajuan');
    Route::get('/pilih-dosbing', [MahasiswaController::class, 'pilih_dosbing'])->name('pilihDosbingPage');
    Route::get('/form-pengajuan', [MahasiswaController::class, 'formPengajuan'])->name('formPengajuan');
    Route::post('/storePengajuan', [MahasiswaController::class, 'storePengajuan'])->name('SimpanPengajuan');
    Route::get('/draft/{id}', [MahasiswaController::class, 'draft_kp'])->name('draftKP');
// Route::post('/draft/update', [MahasiswaController::class, 'updatePengajuan'])->name('updatePengajuan');
// Route::post('/draft/delete', [MahasiswaController::class, 'deletePengajuan'])->name('deletePengajuan');
// Route::post('/draft/submit', [MahasiswaController::class, 'submitPengajuan'])->name('submitPengajuan');
    Route::get('/logbook', [MahasiswaController::class, 'logbook'])->name('halamanLogbook');


    // Route::get('/draft', [MahasiswaController::class, 'draft_penilaian']);
    // Route::get('/Profil/{id}', [MahasiswaController::class, 'profil'])->name('halamanProfil');
    Route::get('/riwayat', [MahasiswaController::class, 'riwayat'])->name('riwayatPengajuan');
    Route::get('/profilmhs', [MahasiswaController::class, 'datadiri']);
    Route::get('/pengajuan_sidang', [MahasiswaController::class, 'penilaian_sidang'])->name('pengajuanSidang');

    // Route::get('/profile-penyelia', [MahasiswaController::class, 'profile_penyelia'])->name('profile_penyelia');
    Route::get('/profile-penyelia', [PenyeliaController::class, 'PenyeliaForm'])->name('profile_penyelia');
    Route::post('/tambah_penyelia', [MahasiswaController::class, 'tambah_penyelia'])->name('halaman_tambah_penyelia');

    Route::get('/detail-penilaian', [MahasiswaController::class, 'detail_penilaian'])->name('detail_penilaian');
    Route::post('/storeDetail', [MahasiswaController::class, 'store_detail_penilaian'])->name('store_detail_penilaian');

    // Route::get('/draft_review', [MahasiswaController::class, 'draft_review'])->name('draft_review');
    Route::post('/submit_draft_review', [MahasiswaController::class, 'submit_review'])->name('submit_review');
});

// Dosen
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen', [DosenPembimbingController::class, 'index'])->name('dashboardDosen');
    Route::get('/daftar_bimbingan', [DosenPembimbingController::class, 'daftar_mhs_bimbingan'])->name('pageDaftarMhsBimbingan');
    Route::get('/logbook_mhs', [DosenPembimbingController::class, 'logbook_bimbingan_mhs'])->name('pageLogbook');
    Route::get('/review_mhs', [DosenPembimbingController::class, 'review_penyelia'])->name('pageReviewPenyelia');
});

// Koordinator
Route::middleware(['auth', 'role:koor'])->group(function () {
    // Koor untuk Dosen
    Route::get('/data_dosen', [KoorController::class, 'daftar_data_dosen'])->name('HalamanKoorDosen');
    Route::post('/import-dosen', [KoorController::class, 'importDosen'])->name('importDosen');
    Route::post('/store-dosen', [KoorController::class, 'storeDosen'])->name('simpanDosen');
    Route::get('/edit-dosen/{id}', [KoorController::class, 'editDosen'])->name('editDosen');
    Route::put('/update-dosen/{id}', [KoorController::class, 'updateDosen'])->name('updateDosen');
    Route::post('delete-dosen/{id}', [KoorController::class, 'deleteDosen'])->name('hapusDosen');

    // Koor untuk Mahasiswa
    Route::get('/data_mhs', [KoorController::class, 'daftar_mhs'])->name('halamanKoorMhs');
    Route::post('/import-mhs', [KoorController::class, 'importMhs'])->name('importMhs');
    Route::post('/store-mhs', [KoorController::class, 'storeMhs'])->name('simpanMhs');
    Route::get('/edit-mhs/{id}', [KoorController::class, 'editMhs'])->name('editMhs');
    Route::put('/update-mhs/{id}', [KoorController::class, 'updateMhs'])->name('updateMhs');
    Route::post('delete-mhs/{id}', [KoorController::class, 'deleteMhs'])->name('hapusMhs');
    Route::get('/penyelia-mhs', [KoorController::class, 'penyeliaMhs'])->name('penyeliaMhs');

    // dashboard
    Route::get('/dashboardKoor', [KoorController::class, 'dashboard'])->name('dashboardKoor');
});

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-Admin', [AdminController::class, 'index'])->name('dashboardAdmin');
    Route::get('/data_user_mhs', [AdminController::class, 'user_mhs'])->name('dataMhs');
    Route::get('/data_user_dosen', [AdminController::class, 'user_dosen'])->name('dataDosen');
    Route::get('/data_user_koor', [AdminController::class, 'user_koor'])->name('dataKoor');
});

//review
Route::post('/submit_review', [ReviewController::class, 'store']);
Route::post('/submit', [PenyeliaController::class, 'store'])->name('submit');
// review penyelia mahasiswa
// Route::get('/Review', [SidebarMahasiswaController::class, 'review_penyelia']);
// Route::get('/detail', [SidebarMahasiswaController::class, 'detail']);
