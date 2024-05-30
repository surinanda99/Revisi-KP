@extends('dosen.layouts.main')
@section('title', 'Daftar Bimbingan Kerja Praktek')
@section('content')
<div class="container">
    <h4 class="mb-4">Daftar Bimbingan Mahasiswa Kerja Praktek</h4>

    <p class="mb-2 d-flex justify-content-between align-items-center">
        Berikut merupakan daftar bimbingan mahasiswa
    </p>
    <blockquote class="blockquote-primary">
        <p class="mb-3">Klik tombol <button type="button" class="btn btn-primary"><i class="fas fa-info-circle"></i></button> untuk melihat detail pengajuan mahasiswa</p>
    </blockquote>
    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <th class="align-middle">No.</th>
                <th class="align-middle">NIM</th>
                <th class="align-middle">Nama Mahasiswa</th>
                <th class="align-middle">IPK</th>
                <th class="align-middle">Detail</th>
                <th class="align-middle">Status</th>
            </thead>
            </thead>
            <tr>
                <td class="centered-column">1</td>
                <td class="centered-column">A11.2021.13489</td>
                <td class="centered-column">Surinanda</td>
                <td class="centered-column">4.00</td>
                <td class="centered-column">
                    <button type="info" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogDetailPengajuan"><i class="fas fa-info-circle"></i></button>
                </td>
                <td class="centered-column">
                    <button type="status" class="btn btn-success rounded-5">diterima</button>
            </tr>
            <tr>
                <td class="centered-column">2</td>
                <td class="centered-column">A11.2021.13472</td>
                <td class="centered-column">Yoga Adi Pratama</td>
                <td class="centered-column">4.00</td>
                <td class="centered-column">
                    <button type="info" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogDetailPengajuan"><i class="fas fa-info-circle"></i></button>
                </td>
                <td class="centered-column">
                    <button type="status" class="btn btn-danger rounded-5">ditolak</button>
            </tr>
            <tr>
                <td class="centered-column">3</td>
                <td class="centered-column">A11.2021.13800</td>
                <td class="centered-column">Nikolas Adi Kurniatmaja Sijabat</td>
                <td class="centered-column">4.00</td>
                <td class="centered-column">
                    <button type="info" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogDetailPengajuan"><i class="fas fa-info-circle"></i></button>
                </td>
                <td class="centered-column">
                    <button type="status" class="btn btn-warning rounded-5">on process</button>
            </tr>
        </table>
    </div>
    <nav aria-label="pageNavigationLogbook">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link active" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
    <!--
    <button type="submit" class="btn btn-primary"><i class="fas fa-chevron-right"></i>Pengajuan Sidang</button>
    -->
</div>

<!--Dialog Tambah Logbook-->
@include('dosen.daftar_bimbingan.detail_bimbingan')

@endsection