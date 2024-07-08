@extends('dosen.layouts.main')
@section('title', 'Daftar Bimbingan Kerja Praktek')
@section('content')

    <!--Dialog Info Logbook-->
    @include('dosen.logbook_bimbingan.detail_logbook')

    <div class="wrapper d-flex flex-column min-vh-100">
        <div class="container flex-grow-1">
            <h3 class="mb-3"><b>Daftar Logbook Mahasiswa Bimbingan</b></h3>
            <p class="mb-5 d-flex justify-content-between align-items-center">
                Berikut merupakan daftar logbook mahasiswa bimbingan
            </p>
            <div class="table-container table-logbook">
                <table class="table table-bordered">
                    <thead class="table-header">
                    <th class="align-middle">No</th>
                    <th class="align-middle">NIM</th>
                    <th class="align-middle">Nama Mahasiswa</th>
                    <th class="align-middle">Jumlah Bimbingan</th>
                    <th class="align-middle">Bab Terakhir</th>
                    <th class="align-middle">Logbook</th>
                    </thead>

                    <tr class="centered-column">
                        <td>1</td>
                        <td>A11.2021.13472</td>
                        <td>Yoga Adi Pratama</td>
                        <td>3</td>
                        <td>2</td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#dialogDetailLogbook">Dokumen</a>
                        </td>
                    </tr>
                </table>
            </div>

            {{-- {{ $logbook->links() }} --}}

@endsection



{{-- @extends('dosen.layouts.main')
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
                    <button type="info" class="btn btn-success"><i class="fas fa-check-circle"></i></button>
                    <button type="info" class="btn btn-danger"><i class="fas fa-times-circle"></i></button>
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

<!--Dialog Detail Logbook-->
@include('dosen.logbook_bimbingan.detail_logbook')
@endsection --}}