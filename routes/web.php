<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\mahasiswaController;
use App\Http\Controllers\dosenController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\KoorController;
use App\Http\Controllers\DosenPembimbingController;
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

// Route::get('/', function () {
//     return view('login');
// });

Route::middleware(['guest'])->group(function(){
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});
Route::get('/home',function(){
    $user = Auth::user();

    if ($user->role == 'mahasiswa') {
        return redirect('/mahasiswa');
    } elseif ($user->role == 'dosen') {
        return redirect('/dosen');
    } elseif ($user->role == 'koor') {
        return redirect('/koor');
    } elseif ($user->role == 'admin') {
        return redirect('/admin');
    }

    return redirect('/login');
})->middleware('auth');

Route::middleware(['auth'])->group(function(){
    Route::get('/mahasiswa', [mahasiswaController::class, 'index'])->middleware('role:mahasiswa');
    Route::get('/dosen', [DosenController::class, 'index'])->middleware('role:dosen');
    Route::get('/koor', [KoorController::class, 'index'])->middleware('role:koor');
    Route::get('/admin', [AdminController::class, 'index'])->middleware('role:admin');
    Route::get('/logout', [SesiController::class, 'logout']);
});

Route::get('/unauthorized', function() {
    return view('unauthorized');
});


//mahasiswa
Route::get('/mahasiswa', [SidebarMahasiswaController::class, 'index']);
Route::get('/pengajuanKP', [SidebarMahasiswaController::class, 'pengajuan_kp']);
Route::get('/logbook', [SidebarMahasiswaController::class, 'logbook_kp']);


//pengajuan mahasiswa
Route::get('/pilih-dosbing', [DosenPembimbingController::class, 'index'])->name('pilihDosbing');
Route::post('/pilih-dosbing', [DosenPembimbingController::class, 'pilihDosen'])->name('pilihDosen');
Route::get('/form-pengajuan', [DosenPembimbingController::class, 'formPengajuan'])->name('formPengajuan');
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
Route::get('/koor', [KoorController::class, 'index']);
Route::get('/data_dosen', [SidebarKoorController::class, 'daftar_data_dosen']);
Route::get('/data_mhs', [SidebarKoorController::class, 'daftar_mhs']);

//admin
Route::get('/data_user_mhs', [SidebarAdminController::class, 'user_mhs']);
Route::get('/data_user_dosen', [SidebarAdminController::class, 'user_dsn']);
Route::get('/data_user_koor', [SidebarAdminController::class, 'user_koor']);

