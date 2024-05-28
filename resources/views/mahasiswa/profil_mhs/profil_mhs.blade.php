@extends('mahasiswa.layouts.main')
@section('title', 'Profil Mahasiswa')
@section('content')
<div class="container">
    <h4 class="mb-4">Profil Mahasiswa</h4>
</div>

<div class="container">
    <form>
        <div class="form-group row mb-3">
            <label for="inputJudul" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="judul" class="form-control" id="inputJudul">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputDeskripsi" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
                <input type="deskripsi" class="form-control" id="inputDeskripsi">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputDeskripsi" class="col-sm-2 col-form-label">Program Studi</label>
            <div class="col-sm-10">
                <input type="deskripsi" class="form-control" id="inputDeskripsi">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputDeskripsi" class="col-sm-2 col-form-label">Dosen Wali</label>
            <div class="col-sm-10">
                <input type="deskripsi" class="form-control" id="inputDeskripsi">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputDeskripsi" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <input type="deskripsi" class="form-control" id="inputDeskripsi">
            </div>
        </div>
    </form>
</div>

@endsection