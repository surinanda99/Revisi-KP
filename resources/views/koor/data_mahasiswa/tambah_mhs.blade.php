@extends('koor.layouts.main')
@section('title', 'Tambah Mahasiswa')

@section('content')
    <div class="container-koor">
        @if (Session::get('error'))
            <div class="row">
                <div class="col-md-4 offset-4 mt-2 py-2 rounded bg-danger text-white fw-bold">
                    {{ Session::get('error') }}
                </div>
            </div>
        @endif
        <h4 class="mb-4">Tambah Mahasiswa</h4>

        <form action="{{ route('simpanMhs') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim" value="{{ old('nim') }}">
                @error('nim')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}">
                @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ipk" class="form-label">IPK</label>
                <input type="text" class="form-control @error('ipk') is-invalid @enderror" name="ipk" id="ipk" value="{{ old('ipk') }}">
                @error('ipk')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="telp_mhs" class="form-label">Telepon Mahasiswa</label>
                <input type="text" class="form-control @error('telp_mhs') is-invalid @enderror" name="telp_mhs" id="telp_mhs" value="{{ old('telp_mhs') }}">
                @error('telp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Mahasiswa</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="dosen_wali" class="form-label">Dosen Wali</label>
                <input type="text" class="form-control @error('dosen_wali') is-invalid @enderror" name="dosen_wali" id="dosen_wali" value="{{ old('dosen_wali') }}">
                @error('dosen_wali')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('halamanKoorMhs') }}" class="btn btn-warning me-2">Kembali</a>
        </form>
    </div>
@endsection
