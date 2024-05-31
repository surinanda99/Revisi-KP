@extends('koor.layouts.main')
@section('title', 'Daftar Data Mahasiwa')
@section('content')
<div class="container-koor">
    <h4 class="mb-4">Data Mahasiswa</h4>

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
                <th class="align-middle">NIM</th>
                <th class="align-middle">Nama Mahasiswa</th>
                <th class="align-middle">IPK</th>
                <th class="align-middle">Telp Mhs</th>
                <th class="align-middle">Email</th>
                <th class="align-middle">Dosen Wali</th>
                <th class="align-middle">Aksi</th>
            </thead>
            <tr>
                <td class="centered-column">1</td>
                <td class="centered-column">A11.2021.13489</td>
                <td class="centered-column">Surinanda</td>
                <td class="centered-column">4.00</td>
                <td class="centered-column">081277491474</td>
                <td class="centered-column">111202113489@dinus.ac.id</td>
                <td class="centered-column">CINANTYA PARAMITA, S.Kom., M.Eng</td>
                <td class="centered-column">
                    <button type="info" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#dialogDetailDataMahasiswa" ><i class="fas fa-info-circle"></i></button>
                    <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#dialogEditMhs"><i class="far fa-edit"></i></button>
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
@include('koor.data_mahasiswa.detail_mhs') 

<!--Dialog Edit Logbook-->
@include('koor.data_mahasiswa.edit_mhs')
{{-- 
<!--Dialog Info Logbook-->
@include('mahasiswa.logbook_kp.detail_logbook')  --}}
@endsection