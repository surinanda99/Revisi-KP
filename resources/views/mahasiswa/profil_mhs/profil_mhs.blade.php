@extends('mahasiswa.layouts.main')
@section('title', 'Profil Mahasiswa')
@section('content')
    <div class="container">
        <h4 class="mb-4">Profil Mahasiswa</h4>
    </div>

    @foreach ($mahasiswas as $mahasiswa)
        <div class="container">
            <form>
                <div class="form-group row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ $mahasiswa->nama }}" readonly>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nim" id="nim" value="{{ $mahasiswa->nim }}" readonly>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="prodi" id="prodi" value="Teknik Informatika" readonly>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="dosen_wali" class="col-sm-2 col-form-label">Dosen Wali</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="dosen_wali" id="dosen_wali" value="{{ $mahasiswa->dosen_wali }}" readonly>
                    </div>
                </div>
                {{-- <div class="form-group row mb-3">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <input type="deskripsi" class="form-control" id="inputDeskripsi">
                    </div>
                </div> --}}
            </form>
        </div>
    @endforeach
@endsection