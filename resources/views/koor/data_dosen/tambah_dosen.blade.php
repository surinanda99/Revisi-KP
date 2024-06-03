@extends('koor.layouts.main')
@section('title', 'Tambah Dosen Pembimbing')

@section('content')
    <div class="container-koor">
        @if (Session::get('error'))
            <div class="row">
                <div class="col-md-4 offset-4 mt-2 py-2 rounded bg-danger text-white fw-bold">
                    {{ Session::get('error') }}
                </div>
            </div>
        @endif
        <h4 class="mb-4">Tambah Dosen Pembimbing</h4>

        <form action="{{ route('simpanDosen') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="npp" class="form-label">NPP</label>
                <input type="text" class="form-control @error('npp') is-invalid @enderror" name="npp" id="npp" value="{{ old('npp') }}">
                @error('npp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Dosen Pembimbing</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}">
                @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="bidang_kajian" class="form-label">Bidang Kajian</label>
                <select class="form-select form-control @error('bidang_kajian') is-invalid @enderror" name="bidang_kajian" id="bidang_kajian">
                    <option selected value="0">Pilih Bidang Kajian</option>
                    <option value="RPLD" {{ old('bidang_kajian') === 'RPLD' ? 'selected' : '' }}>RPLD</option>
                    <option value="SC" {{ old('bidang_kajian') === 'SC' ? 'selected' : '' }}>SC</option>
                </select>
                @error('bidang_kajian')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kuota" class="form-label">Kuota Mhs KP Baru</label>
                <input type="number" class="form-control @error('kuota') is-invalid @enderror" name="kuota" id="kuota" value="{{ old('kuota') }}">
                @error('kuota')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jumlah_ajuan" class="form-label">Jumlah Ajuan</label>
                <input type="number" class="form-control @error('jumlah_ajuan') is-invalid @enderror" name="jumlah_ajuan" id="jumlah_ajuan" value="{{ old('jumlah_ajuan') }}">
                @error('jumlah_ajuan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="ajuan_diterima" class="form-label">Ajuan Diterima</label>
                <input type="number" class="form-control  @error('ajuan_diterima') is-invalid @enderror" name="ajuan_diterima" id="ajuan_diterima" value="{{ old('ajuan_diterima') }}">
                @error('ajuan_diterima')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="sisa_kuota" class="form-label">Sisa Kuota</label>
                <input type="number" class="form-control @error('ajuan_diterima') is-invalid @enderror" name="sisa_kuota" id="sisa_kuota" value="{{ old('sisa_kuota') }}">
                @error('sisa_kuota')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select form-control @error('status') is-invalid @enderror" name="status" id="status">
                    <option selected value="0">Pilih Status</option>
                    <option value="Penuh" {{ old('status') === 'Penuh' ? 'selected' : '' }}>Penuh</option>
                    <option value="Tersedia" {{ old('status') === 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                </select>
                @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('HalamanKoorDosen') }}" class="btn btn-warning me-2">Kembali</a>
        </form>
    </div>
@endsection