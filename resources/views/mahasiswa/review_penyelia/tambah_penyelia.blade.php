@extends('mahasiswa.layouts.main')
@section('title', 'Form Mahasiswa')
@section('content')
<div class="container">
    <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-dosbing" class="nav-link active rounded-pill">
                <i class="fas fa-chalkboard-teacher"></i>
                Profil Penyelia
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link rounded-pill">
                <i class="fas fa-edit"></i>
                Detail Penilaian
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link rounded-pill">
                <i class="fas fa-book-open"></i>
                Draft Review Penilaian
            </a>
        </li>
    </ul>

<div class="container">
    <h4 class="mb-4">Profil Penyelia</h4>
    <blockquote class="blockquote-primary">
        <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
    </blockquote>
</div>


<div class="container">
    <form>
        <div class="form-group row mb-3">
            <label for="inputTopik" class="col-sm-2 col-form-label">Nama<span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="topik" class="form-control" id="inputTopik" placeholder="Masukkan Nama Penyelia">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputJudul" class="col-sm-2 col-form-label">Posisi <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="judul" class="form-control" id="inputJudul" placeholder="Masukkan Posisi Penyelia">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputDeskripsi" class="col-sm-2 col-form-label">Departemen <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="deskripsi" class="form-control" id="inputDeskripsi" placeholder="Masukkan Departemen penyelia">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputDeskripsi" class="col-sm-2 col-form-label">Perusahaan <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="deskripsi" class="form-control" id="inputDeskripsi" placeholder="Masukkan Perusahaan">
            </div>
        </div>
        <div class="form-group row mb-3 justify-content-end">
            <div class="col-sm-1 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2">Kembali</button>
                <button type="button" class="btn btn-primary me-2">Simpan</button>
            </div>
        </div>
    </form>
</div>
</div>

</body>
</html>
@endsection