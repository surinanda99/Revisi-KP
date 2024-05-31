@extends('koor.layouts.main')
@section('title', 'Daftar Data Dosen')
@section('content')
<div class="container-koor">
    <h4 class="mb-4">Data Dosen Pembimbing</h4>

    <p class="mb-2 d-flex align-items-center">
        <button type="submit" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#dialogTambahLogbook">
            <i class="fas fa-plus"></i> Tambah</button>
        <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#dialogTambahLogbook">
            <i class="lni lni-exit-down"></i> Import</button>
    </p>
    
    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <th class="align-middle">No.</th>
                <th class="align-middle">NPP</th>
                <th class="align-middle">Nama Dosen Pembimbing</th>
                <th class="align-middle">Bidang Kajian</th>
                <th class="align-middle">Kuota Mhs KP baru</th>
                <th class="align-middle">Jumlah Ajuan</th>
                <th class="align-middle">Ajuan Diterima</th>
                <th class="align-middle">Sisa Kouta</th>
                <th class="align-middle">Status</th>
                <th class="align-middle">Aksi</th>
            </thead>
            <tr>
                <td class="centered-column">1</td>
                <td class="centered-column">0686.11.2012.444</td>
                <td class="centered-column">Adhitya Nugraha, S.Kom, M.CS</td>
                <td class="centered-column">RPLD/SC</td>
                <td class="centered-column">4</td>
                <td class="centered-column">4</td>
                <td class="centered-column">2</td>
                <td class="centered-column">2</td>
                <td class="centered-column">Penuh/Tersedia</td>
                <td class="centered-column">
                    <button type="info" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogDetailDataDosen" ><i class="fas fa-info-circle"></i></button>
                    <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#dialogEditDosen"><i class="far fa-edit"></i></button>
                    <button type="submit" class="btn btn-danger" ><i class="fas fa-trash"></i></button>
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
@include('koor.data_dosen.detail_dosen')

<!--Dialog Edit Logbook-->
@include('koor.data_dosen.edit_dosen')
{{-- 
<!--Dialog Info Logbook-->
@include('mahasiswa.logbook_kp.detail_logbook')  --}}
@endsection