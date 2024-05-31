<?php

use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\dosenController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\SidebarMahasiswaController;
use App\Http\Controllers\SidebarDosenController;
use App\Http\Controllers\SidebarKoorController;
use App\Http\Controllers\SidebarAdminController;
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

// //mahasiswa
// Route::get('/halamanDosen', [mahasiswaController::class, 'index']);
// Route::get('/halamanPengajuan', [mahasiswaController::class, 'create'])->name('pengajuan');
// Route::get('/draftPengajuan', [mahasiswaController::class, 'draft']);
// Route::get('/dashboardMahasiswa', [mahasiswaController::class, 'dashboard'])->name('home');
// Route::get('/riwayatMahasiswa', [mahasiswaController::class, 'history'])->name('riwayat');
// Route::get('/reviewMahasiswa', [mahasiswaController::class, 'hasil'])->name('review');
// Route::get('/rejectedMahasiswa', [mahasiswaController::class, 'tolak']);


// //dosen
// Route::get('/daftarBimbingan', [dosenController::class, 'list']);
// Route::get('/rincianDocument', [dosenController::class, 'rinci']);
// Route::get('/dosen', [dosenController::class, 'list']);

// //admin
// Route::get('/halaman-admin-bimbingan', [adminController::class, 'mhsBimbingan']);


//mahasiswa
Route::get('/mahasiswa', [SidebarMahasiswaController::class, 'index']);
Route::get('/pengajuanKP', [SidebarMahasiswaController::class, 'pengajuan_kp']);
Route::get('/logbook', [SidebarMahasiswaController::class, 'logbook_kp']);


//pengajuan mahasiswa
Route::get('/form', [SidebarMahasiswaController::class, 'form_kp']);
Route::get('/draft', [SidebarMahasiswaController::class, 'draft_kp']);

//review penyelia mahasiswa
Route::get('/Review', [SidebarMahasiswaController::class, 'review_penyelia']);
Route::get('/detail', [SidebarMahasiswaController::class, 'detail']);

//profil mahasiswa
Route::get('/Profil', [SidebarMahasiswaController::class, 'profil_mhs']);

//dosen
Route::get('/dosen', [SidebarDosenController::class, 'index']);
Route::get('/daftar_bimbingan', [SidebarDosenController::class, 'daftar_mhs_bimbingan']);
Route::get('/logbook_mhs', [SidebarDosenController::class, 'logbook_bimbingan_mhs']);
Route::get('/review_mhs', [SidebarDosenController::class, 'review_penyelia']);

//koor
Route::get('/data_dosen', [SidebarKoorController::class, 'daftar_data_dosen']);
Route::get('/data_mhs', [SidebarKoorController::class, 'daftar_mhs']);

//admin
Route::get('/data_user_mhs', [SidebarAdminController::class, 'user_mhs']);
Route::get('/data_user_dosen', [SidebarAdminController::class, 'user_dsn']);
Route::get('/data_user_koor', [SidebarAdminController::class, 'user_koor']);

