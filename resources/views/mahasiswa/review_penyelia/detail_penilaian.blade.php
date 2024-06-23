@extends('mahasiswa.layouts.main')
@section('title', 'Detail Penilaian')
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
    <h4 class="mb-4">Detail Penilaian</h4>
    <blockquote class="blockquote-primary">
        <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
    </blockquote>
</div>


<div class="container">
    <form>
        <div class="form-group row mb-3">
            <label for="inputTopik" class="col-sm-2 col-form-label">Deskripsi Pekerjaan<span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="topik" class="form-control" id="inputTopik" placeholder="Masukkan Deskripsi Pekerjaan">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputJudul" class="col-sm-2 col-form-label">Prestasi dan Kontribusi <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="judul" class="form-control" id="inputJudul" placeholder="Masukkan Prestasi dan Kontribusi">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputDeskripsi" class="col-sm-2 col-form-label">Keterampilan dan Kemampuan <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="deskripsi" class="form-control" id="inputDeskripsi" placeholder="Masukkan Keterampilan dan Kemampuan">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputDeskripsi" class="col-sm-2 col-form-label">Kerjasama Dan Keterlibatan <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="deskripsi" class="form-control" id="inputDeskripsi" placeholder="Masukkan Kerjasama Dan Keterlibatan ">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputCatatan" class="col-sm-2 col-form-label">Komentar</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="inputCatatan" rows="3" placeholder="Masukkan Komentar"></textarea>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputDeskripsi" class="col-sm-2 col-form-label">Perkembangan <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="deskripsi" class="form-control" id="inputDeskripsi" placeholder="Masukkan Perkembangan">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputCatatan" class="col-sm-2 col-form-label">Kesimpulan dan Saran</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="inputCatatan" rows="3" placeholder="Masukkan Kesimpulan dan Saran"></textarea>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputDeskripsi" class="col-sm-2 col-form-label">Score <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="deskripsi" class="form-control" id="inputDeskripsi" placeholder="Masukkan Score">
            </div>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">file</label>
            <input class="form-control" type="file" id="formFile">
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