<?php

use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\SidebarMahasiswaController;
// use App\Http\Controllers\SidebarDosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KoorController;
// use App\Http\Controllers\SidebarAdminController;
// use App\Http\Controllers\DosenPembimbingController;
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

Route::get('/', function () {
    return view('login');
});

// Mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('dashboardMahasiswa');
Route::get('/pengajuanKP', [MahasiswaController::class, 'pengajuan_kp'])->name('halamanPengajuan');
Route::get('/pilih-dosbing', [MahasiswaController::class, 'pilih_dosbing'])->name('pilihDosbingPage');
Route::get('/form-pengajuan', [MahasiswaController::class, 'formPengajuan'])->name('formPengajuan');
Route::post('/storePengajuan', [MahasiswaController::class, 'storePengajuan'])->name('SimpanPengajuan');
Route::get('/draft', [MahasiswaController::class, 'draft_kp'])->name('draftKP');






// Mahasiswa
// Route::get('/mahasiswa', [SidebarMahasiswaController::class, 'index']);
// Route::get('/pengajuanKP', [SidebarMahasiswaController::class, 'pengajuan_kp']);
// Route::get('/logbook', [SidebarMahasiswaController::class, 'logbook_kp']);


//pengajuan mahasiswa
// Route::get('/pilih-dosbing', [DosenPembimbingController::class, 'index'])->name('pilihDosbing');
// Route::post('/pilih-dosbing', [DosenPembimbingController::class, 'pilihDosen'])->name('pilihDosen');
// Route::get('/form-pengajuan', [DosenPembimbingController::class, 'formPengajuan'])->name('formPengajuan');
// Route::get('/form', [SidebarMahasiswaController::class, 'form_kp']);
// Route::get('/draft', [SidebarMahasiswaController::class, 'draft_kp']);

//review penyelia mahasiswa
// Route::get('/Review', [SidebarMahasiswaController::class, 'review_penyelia']);
// Route::get('/detail', [SidebarMahasiswaController::class, 'detail']);

//profil mahasiswa
// Route::get('/Profil', [SidebarMahasiswaController::class, 'profil_mhs']);

//dosen
// Route::get('/dosen', [SidebarDosenController::class, 'index']);
// Route::get('/daftar_bimbingan', [SidebarDosenController::class, 'daftar_mhs_bimbingan']);
// Route::get('/logbook_mhs', [SidebarDosenController::class, 'logbook_bimbingan_mhs']);
// Route::get('/review_mhs', [SidebarDosenController::class, 'review_penyelia']);

//koor untuk Dosen
Route::get('/data_dosen', [KoorController::class, 'daftar_data_dosen'])->name('HalamanKoorDosen');
Route::post('/import-dosen', [KoorController::class, 'importDosen'])->name('importDosen');
Route::get('/tambah-dosen', [KoorController::class, 'addDosen'])->name('tambahDosen');
Route::post('/store', [KoorController::class, 'storeDosen'])->name('simpanDosen');
Route::get('/edit-dosen/{id}', [KoorController::class, 'editDosen'])->name('editDosen');
Route::put('/update/{id}', [KoorController::class, 'updateDosen'])->name('updateDosen');
Route::post('delete/{id}', [KoorController::class, 'deleteDosen'])->name('hapusDosen');


// Koor untuk Mahasiswa
Route::get('/data_mhs', [KoorController::class, 'daftar_mhs']);

//admin
// Route::get('/data_user_mhs', [SidebarAdminController::class, 'user_mhs']);
// Route::get('/data_user_dosen', [SidebarAdminController::class, 'user_dsn']);
// Route::get('/data_user_koor', [SidebarAdminController::class, 'user_koor']);

