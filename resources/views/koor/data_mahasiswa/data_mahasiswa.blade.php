@extends('koor.layouts.main')
@section('title', 'Daftar Data Mahasiwa')
@section('content')
<div class="container-koor">
    <h4 class="mb-4">Data Mahasiswa</h4>

    <p class="mb-2 d-flex align-items-center">
        <div class="col-md">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogTambah"><i class="fas fa-plus"></i>Tambah Data</a>
            <button class="btn btn-success ms-1" data-bs-toggle="modal" data-bs-target="#dialogImport"><i class="fas fa-file-import"></i>&nbsp;Import</button>
        </div>

         <!-- Import Mahasiswa Modal -->
         <div class="modal fade" id="dialogImport" tabindex="-1" aria-labelledby="dialogImportLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('importMhs') }}" class="modal-content" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="dialogImportLabel">Import Data Mahasiswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="exampleFormControlInput1" class="form-label fw-semibold">Data Excel</label>
                            <input type="file" class="form-control @error('import') is-invalid @enderror" name="import" placeholder="Masukkan data excel" value="{{ old('import') }}">
                            @error('import')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </p>

    @if (Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::get('error'))
        <div class="alert alert-danger mt-3">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <th class="align-middle">No.</th>
                <th class="align-middle">NIM</th>
                <th class="align-middle">Nama Mahasiswa</th>
                <th class="align-middle">IPK</th>
                <th class="align-middle">Transkip</th>
                <th class="align-middle">Telp Mhs</th>
                <th class="align-middle">Email</th>
                <th class="align-middle">Dosen Wali</th>
                <th class="align-middle">Aksi</th>
            </thead>
            <tbody>

                <!-- Loop untuk Menampilkan Setiap Data Mahasiswa -->
                @foreach($mahasiswas as $mahasiswa)
                <tr>
                    <td class="centered-column">{{ $loop->iteration }}</td>
                    <td class="centered-column">{{ $mahasiswa->nim }}</td>
                    <td class="centered-column">{{ $mahasiswa->nama }}</td>
                    <td class="centered-column">{{ $mahasiswa->ipk }}</td>
                    <td class="centered-column">{{ $mahasiswa->transkrip_nilai }}</td>
                    <td class="centered-column">{{ $mahasiswa->telp_mhs }}</td>
                    <td class="centered-column">{{ $mahasiswa->email }}</td>
                    <td class="centered-column">{{ $mahasiswa->dosen_wali }}</td>
                    <td class="centered-column">
                        <button class="btn btn-primary btn-detail" data-bs-toggle="modal" data-bs-target="#dialogDetailDataMahasiswa_{{ $mahasiswa->id }}">
                            <i class="fas fa-info-circle"></i>
                        </button>
                        <button class="btn btn-warning me-1 btn-edit" data-id="{{ $mahasiswa->id }}" data-bs-toggle="modal" data-bs-target="#dialogEditMhs_{{ $mahasiswa->id }}">
                            <i class="far fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-delete" data-id="{{ $mahasiswa->id }}" data-bs-toggle="modal" data-bs-target="#dialogHapusMhs_{{ $mahasiswa->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
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

<!--Dialog detail mahasiswa-->
@include('koor.data_mahasiswa.detail_mhs')

<!--Dialog Edit mahasiswa-->
@include('koor.data_mahasiswa.edit_mhs')

<!--Dialog Tambah Mahasiswa-->
@include('koor.data_mahasiswa.tambah_data')

<!--Dialog Hapus Mahasiswa-->
@include('koor.data_mahasiswa.hapus')
@endsection
