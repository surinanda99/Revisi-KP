<?php

use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\dosenController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\SidebarMahasiswaController;
use App\Http\Controllers\SidebarDosenController;
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

//review penyelia
Route::get('/Review', [SidebarMahasiswaController::class, 'review_penyelia']);
Route::get('/detail', [SidebarMahasiswaController::class, 'detail']);

//profil
Route::get('/Profil', [SidebarMahasiswaController::class, 'profil_mhs']);

//dosen
Route::get('/dosen', [SidebarDosenController::class, 'daftar_mhs_bimbingan']);
Route::get('/logbook_mhs', [SidebarDosenController::class, 'logbook_bimbingan_mhs']);

