@extends('mahasiswa.layouts.main')
@section('title', 'Logbook Bimbingan Kerja Praktek')
@section('content')
<div class="container">
    <h4 class="mb-4">Bimbingan KP</h4>

    <p class="mb-2 d-flex justify-content-between align-items-center">
        Berikut merupakan daftar progres bimbingan yang sudah dilakukan oleh mahasiswa dengan dosen pembimbing
        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogTambahLogbook"> <i class="fas fa-plus"></i>Tambah</button>
    </p>
    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <th class="align-middle">No.</th>
                <th class="align-middle">Tanggal</th>
                <th class="align-middle">Uraian Bimbingan</th>
                <th class="align-middle">Bab Terakhir Bimbingan</th>
                <th class="align-middle">Status</th>
                <th class="align-middle">Aksi</th>
            </thead>
            <tr>
                <td class="centered-column">1</td>
                <td class="centered-column">30 April 2024</td>
                <td class="content-column">Membahas coding</td>
                <td class="centered-column">Bab I</td>
                <td class="centered-column">
                    <button type="status" class="btn btn-success rounded-5">ACC
                        <i class="fas fa-check icon-dark-acc"></i>
                    </button>
                    <!--
                    <button type="status" class="btn btn-danger rounded-5">Belum ACC
                        <i class="fas fa-times icon-dark-no"></i>
                    </button>
                    -->
                </td>
                <td class="centered-column">
                    <button type="info" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogDetailLogbook"><i class="fas fa-info-circle"></i></button>
                    <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#dialogEditLogbook"><i class="far fa-edit"></i></button>
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
@include('mahasiswa.logbook_kp.tambah_logbook')

<!--Dialog Edit Logbook-->
@include('mahasiswa.logbook_kp.edit_logbook')

<!--Dialog Info Logbook-->
@include('mahasiswa.logbook_kp.detail_logbook')
@endsection