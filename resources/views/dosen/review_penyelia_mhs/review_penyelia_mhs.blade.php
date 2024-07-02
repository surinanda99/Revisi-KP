@extends('dosen.layouts.main')
@section('title', 'Daftar Review Penyelia')
@section('content')
<div class="container">
    <h4 class="mb-4">Review Penilaian Penyelia Mahasiswa Kerja Praktek</h4>

    <p class="mb-2 d-flex justify-content-between align-items-center">
        <blockquote class="blockquote-primary">
            <p class="mb-3">Klik tombol <button type="button" class="btn btn-primary"><i class="lni lni-empty-file"></i></button> untuk melihat detail Review Penyelia mahasiswa</p>
            <p class="mb-3">Klik tombol <button type="button" class="btn btn-secondary"><i class="fas fa-lock"></i></button> untuk menutup halaman Review Penyelia pada mahasiswa</p>
            <p class="mb-3">Klik tombol <button type="button" class="btn btn-info"><i class="fas fa-unlock"></i></button> untuk membuka halaman Review Penyelia pada mahasiswa</p>
        </blockquote>
        Berikut merupakan daftar Detail Penilaian Mahasiswa
    </p>
    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <th class="align-middle">No.</th>
                <th class="align-middle">NIM</th>
                <th class="align-middle">Nama Mahasiswa</th>
                <th class="align-middle">Detail</th>
                <th class="align-middle">Dokumen</th>
                <th class="align-middle">Aksi</th>
            </thead>
            </thead>
            <tr>
                <td class="centered-column">1</td>
                <td class="centered-column">A11.2021.13489</td>
                <td class="centered-column">Surinanda</td>
                <td class="centered-column"></td>
                <td class="centered-column"></td>
                <td class="centered-column">
                    <button type="info" class="btn btn-secondary"><i class="fas fa-lock"></i></button>
                    <button type="info" class="btn btn-info"><i class="fas fa-unlock"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="centered-column">2</td>
                <td class="centered-column">A11.2021.13800</td>
                <td class="centered-column">Nikolas Adi Kurniatmaja Sijabat</td>
                <td class="centered-column">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogDetailRiwayat">
                <i class="fas fa-file-alt"></i>
                </button></td>
                <td class="centered-column"><a href="https://drive.google.com/drive/folders/1NSgwE4CEOqnPBZrfcoIu7wSFYuvvCu-O?usp=drive_link" target="_blank">Dokumen</a></td>
                <td class="centered-column">
                    <button type="info" class="btn btn-info"><i class="fas fa-lock"></i></button>
                    <button type="info" class="btn btn-secondary"><i class="fas fa-unlock"></i></button>
                </td>
            </tr>
        </table>
    </div>
    <nav aria-label="pageNavigationReviewPenyelia">
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

<!--Dialog Detail Logbook-->
@include('dosen.review_penyelia_mhs.detail_riwayat')

@endsection