@extends('mahasiswa.layouts.main')
@section('title', 'Form Pengajuan')
@section('content')
<div class="container">
    <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-dosbing" class="nav-link rounded-pill">
                <i class="fas fa-chalkboard-teacher"></i>
                Dosen Pembimbing
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link active rounded-pill">
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

    <div class="tab-content">
        <div id="nav-tab-dosbing" class="tab-pane fade">
            <!-- Konten untuk pilih dosbing di sini -->
        </div>
        <div id="nav-tab-pengajuan" class="tab-pane fade show active">
            <div class="container">
                <h4 class="mb-4">Pengajuan Kerja Praktek</h4>
                <blockquote class="blockquote-primary">
                    <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
                </blockquote>
            </div>
            <div class="container">
                <form>
                    <div class="form-group row mb-3">
                        <label for="inputBidang" class="col-sm-2 col-form-label">Kategori Bidang <span class="required">*</span></label>
                        <div class="col-sm-3">
                            <select class="form-select" id="inputBidang" aria-label="Bidang Kajian">
                                <option disabled selected hidden>Pilih Bidang</option>
                                <option value="SC">Web Development</option>
                                <option value="RPLD">Application Development</option>
                                <option value="RPLD">Game Development</option>
                                <option value="RPLD">Data Analysis</option>
                                <option value="RPLD">Data Science</option>
                                <option value="RPLD">Artificial Intelligence</option>
                                <option value="RPLD">Graphic Design</option>
                                <option value="RPLD">Networking</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputTopik" class="col-sm-2 col-form-label">Judul Sementara <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="topik" class="form-control" id="inputTopik" placeholder="Masukkan Judul Sementara">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputJudul" class="col-sm-2 col-form-label">Perusahaan <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="judul" class="form-control" id="inputJudul" placeholder="Masukkan Perusahaan">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputDeskripsi" class="col-sm-2 col-form-label">Posisi <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="deskripsi" class="form-control" id="inputDeskripsi" placeholder="Masukkan Posisi">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputCatatan" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="inputCatatan" rows="3" placeholder="Masukkan Deskripsi"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputDeskripsi" class="col-sm-2 col-form-label">Durasi Magang <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="deskripsi" class="form-control" id="inputDeskripsi" placeholder="Masukkan Durasi">
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
        <div id="nav-tab-draft" class="tab-pane fade">
            <!-- Konten untuk draft pengajuan di sini -->
        </div>
    </div>
</div>
@endsection
