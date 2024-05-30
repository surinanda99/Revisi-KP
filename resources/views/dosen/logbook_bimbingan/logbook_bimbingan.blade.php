@extends('dosen.layouts.main')
@section('title', 'Daftar Bimbingan Kerja Praktek')
@section('content')
<div class="container">
    <h4 class="mb-4">Daftar Logbook Mahasiswa Kerja Praktek</h4>

    <p class="mb-2 d-flex justify-content-between align-items-center">
        Berikut merupakan daftar Logbook bimbingan mahasiswa
    </p>
    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <th class="align-middle">No.</th>
                <th class="align-middle">Tanggal</th>
                <th class="align-middle">NIM</th>
                <th class="align-middle">Nama Mahasiswa</th>
                <th class="align-middle">Uraian Bimbingan</th>
                <th class="align-middle">Bab Terakhir</th>
                <th class="align-middle">Dokumen</th>
                <th class="align-middle">Status</th>
            </thead>
            </thead>
            <tr>
                <td class="centered-column">1</td>
                <td class="centered-column">2024-05-23</td>
                <td class="centered-column">A11.2021.13489</td>
                <td class="centered-column">Surinanda</td>
                <td class="centered-column">cape bat anying</td>
                <td class="centered-column">Bab 1</td>
                <td class="centered-column"><a href="https://drive.google.com/drive/folders/1NSgwE4CEOqnPBZrfcoIu7wSFYuvvCu-O?usp=drive_link" target="_blank">Dokumen</a></td>
                <td class="centered-column">
                    <button type="info" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#dialogDetailLogbook"><i class="fas fa-check-circle"></i></button>
                    <button type="info" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#dialogDetailLogbook"><i class="fas fa-times-circle"></i></button>
                </td>
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
@include('dosen.logbook_bimbingan.detail_logbook')

{{-- <!--Dialog Edit Logbook-->
@include('mahasiswa.logbook_kp.edit_logbook')

<!--Dialog Info Logbook-->
@include('mahasiswa.logbook_kp.detail_logbook')  --}}
@endsection


{{-- @extends('dosen.layouts.main')
@section('title', 'Mahasiswa Bimbingan')
@section('content')
<div class="container">
    <h4 class="mb-4">Daftar Mahasiswa Bimbingan</h4>
    <p class="mb-2">Berikut ini adalah daftar mahasiswa bimbingan</p>
    <blockquote class="blockquote-primary">
        <p class="mb-3 px-3">Tekan tombol <button type="button" class="btn btn-warning" disabled><i class="fas fa-info-circle"></i></i></button> untuk melihat detail mahasiswa bimbingan</p>
    </blockquote>
    <div class="input-group justify-content-end mb-3">
        <input class="form-control" type="text" placeholder="Search here..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
        <button class="btn" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
    </div>
    <div class="table-container table-dosbing">
        <table class="table table-bordered mb-1">
            <thead class="table-header">
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>IPK</th>
                <th>Detail</th>
            </thead>

            <tr>

                <td class="centered-column"></td>
                <td class="centered-column"></td>
                <td class="centered-column"></td>
                <td class="centered-column"></td>
                <td class="centered-column">
                    <button type="info" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#dialogDetailPengajuan"><i class="fas fa-info-circle"></i></button>
                    </a>
                </td>
            </tr>

        </table>
    </div>

    <nav aria-label="pageNavigationDosbing">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-regular fa-chevron-left"></i></a>
            </li>
            <li class="page-item"><a class="page-link active" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="#">40</a></li>
            <li class="page-item">
                <a class="page-link" href="#"><i class="fas fa-regular fa-chevron-right"></i></a>
            </li>
        </ul>
    </nav>
</div>

{{-- <!--Dialog Tambah Logbook-->
@include('dosen.daftar_bimbingan.daftar_bimbingan') --}}

{{-- <!--Dialog Edit Logbook-->
@include('mahasiswa.logbook_kp.edit_logbook')

<!--Dialog Info Logbook-->
@include('mahasiswa.logbook_kp.detail_logbook') --}}
{{-- @endsection --}} 