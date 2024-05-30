@extends('mahasiswa.layouts.main')
@section('title', 'Dashboard Mahasiswa')
@section('content')
<div class="container-dashboard">
    <h1>Hi,</h1>
    <div class="type">
        <h1>Surinanda</h1>
    </div>
    <p>Siap untuk kerja praktek hari ini?</p>
</div>
<main class="container-border">
    <div class="row">
        <div class="col-md-8 py-5">
            <h1><i class="far fa-calendar-check"></i> Aktivitas Terbaru</h1>
            <div class="table-container table-aktivitas">
                <table class="table table-bordered">
                    <thead class="table-header">
                        <th class="align-middle">No.</th>
                        <th class="align-middle">Aktivitas</th>
                        <th class="align-middle">Tanggal Pengajuan</th>
                        <th class="align-middle">Status</th>
                    </thead>
                    <tr>
                        <td class="centered-column">1</td>
                        <td class="content-column">Pengajuan Bimbingan Kerja Praktek</td>
                        <td class="centered-column">05 April 2024</td>
                        <td class="centered-column">
                            <button type="status" class="btn btn-danger rounded-5">ditolak
                                <i class="fas fa- icon-dark-acc"></i>
                            </button>
                            <!--
                            <button type="status" class="btn btn-danger rounded-5">Belum ACC
                                <i class="fas fa-times icon-dark-no"></i>
                            </button>
                            -->
                        </td>
                    <tr>
                        <td class="centered-column">2</td>
                        <td class="content-column">Pengajuan Bimbingan Kerja Praktek</td>
                        <td class="centered-column">30 April 2024</td>
                        <td class="centered-column">
                            <button type="status" class="btn btn-success rounded-5">diterima
                                <i class="fas  icon-dark-acc"></i>
                            </button>
                            <!--
                            <button type="status" class="btn btn-danger rounded-5">Belum ACC
                                <i class="fas fa-times icon-dark-no"></i>
                            </button>
                            -->
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-4 py-5">
            <h1><i class="fas fa-bell"></i> Notifikasi</h1>
            <p>Dosen Pembimbing telah menerima topikmu! Silahkan ke halaman Logbook untuk mengisi catatan bimbingan.</p>
            <button type="submit" class="btn btn-primary"><i class="fas fa-chevron-right"></i>Menuju ke Halaman</button>
        </div>
    </div>
</main>

@endsection