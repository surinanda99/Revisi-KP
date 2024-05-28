@extends('mahasiswa.layouts.main')
@section('title', 'Form Mahasiswa')
@section('content')
<div class="container">
    <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-dosbing" class="nav-link active rounded-pill">
                <i class="fas fa-chalkboard-teacher"></i>
                Dosen Pembimbing
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link rounded-pill">
                <i class="fas fa-edit"></i>
                Form Pengajuan
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-draft" class="nav-link rounded-pill">
                <i class="fas fa-book-open"></i>
                Draft Pengajuan
            </a>
        </li>
    </ul>

    <div class="container mt-5">
        <h4>Pengajuan Bimbingan KP</h4>
        <div class="row mt-5">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-2 text-start">
                        <label for="judul" class="form-label">Kategori Bidang </label>
                    </div>
                    <div class="col-10">
                        <input class="form-control" type="text" id="judul" name="judul">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2 text-start">
                        <label for="keyword" class="form-label">Judul Sementara</label>
                    </div>
                    <div class="col-10">
                        <input class="form-control" type="text" id="keyword" name="keyword">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2 text-start">
                        <label for="perusahaan" class="form-label">Perusahaan</label>
                    </div>
                    <div class="col-10">
                        <input class="form-control" type="text" id="perusahaan" name="perusahaan">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2 text-start">
                        <label for="posisi" class="form-label">Posisi</label>
                    </div>
                    <div class="col-10">
                        <input class="form-control" type="text" id="posisi" name="posisi">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-2 text-start">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                    </div>
                    <div class="col-10">
                        <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
                    </div>
                </div>
                <div class="row mt-4 mb-5">
                    <div class="col-2 text-start">
                        <label for="catatan" class="form-label">Durasi Magang</label>
                    </div>
                    <div class="col-10">
                        <input class="form-control" type="text" id="catatan" name="catatan">
                    </div>
                </div>
                <button class="btn btn-primary mt-5 mb-3 me-5" style="width: 100px" type="submit">Ajukan</button>
                <a href="" class="btn btn-warning mt-5 mb-3 me-5" style="width: 100px">Edit</a>
                <button class="btn btn-danger mt-5 mb-3" style="width: 100px">Delete</button>
            </form>
        </div>
    </div>
</div>

@endsection
