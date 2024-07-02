@extends('mahasiswa.layouts.main')
@section('title', 'Dashboard Mahasiswa')
@section('content')

    <div class="container-dashboard">
        <h1>Hi, {{ $mhs['nama'] }}</h1>
        <div class="type">
            <h1></h1>
        </div>
        <p>Siap untuk kerja praktek hari ini?</p>
    </div>

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

    <main class="container-border">
        <div class="container">
            <form action="{{ route('updateMhs', ['id' => $mhs->id]) }}" method="POST">
                @csrf
                <h4 class="text-center">Lengkapi Data Diri</h4>
                <hr>
                <div class="form-group row mb-3">
                    <label for="inputTelp" class="col-sm-2 col-form-label">Nomor Telepon <span class="required">*</span></label>
                    <div class="col-sm-10">
                        <input type="tel" class="form-control @error('telp_mhs') is-invalid @enderror" name="telp_mhs" id="inputTelp" placeholder="Masukkan Nomor Telepon" value="{{ old('telp_mhs') ? old('telp_mhs') : $mhs->telp_mhs }}">
                        @error('telp_mhs')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="inputIPK" class="col-sm-2 col-form-label">IPK <span class="required">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('ipk') is-invalid @enderror" name="ipk" id="inputIPK" placeholder="Masukkan IPK" value="{{ old('ipk') ? old('ipk') : $mhs->ipk }}">
                        @error('ipk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="inputTranskrip" class="col-sm-2 col-form-label">Upload Link Transkrip Nilai <span class="required">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('transkrip_nilai') is-invalid @enderror" name="transkrip_nilai" id="inputTranskrip" placeholder="Masukkan Link Transkrip" value="{{ old('transkrip_nilai') ? old('transkrip_nilai') : $mhs->transkrip_nilai }}">
                        @error('transkrip_nilai')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-sm-10 offset-sm-2 text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>

            {{-- Tombol Pengajuan Dosen Pembimbing jika belum melakukan pengajuan --}}
            @if (!$mhs->pengajuan_status)
                <div class="alert alert-warning" role="alert">
                    Anda belum menyelesaikan Kerja Praktek.
                </div>
                <a href="{{ route('halamanPengajuan') }}" class="btn btn-primary"><i class="fas fa-chevron-right"></i> Pengajuan Dosen Pembimbing</a>
            @endif

            @if ($mhs->pengajuan_status)
                <div class="row">
                    <div class="col-md-8 py-5">
                        <h1><i class="far fa-calendar-check"></i> Aktivitas Terbaru</h1>
                        <div class="table-container table-aktivitas">
                            <table class="table table-bordered">
                                <thead class="table-header">
                                    <th class="align-middle">No.</th>
                                    <th class="align-middle">Aktivitas</th>
                                    <th class="align-middle">Tanggal Pengajuan</th>
                                    <th class="align-middle">Status</th>
                                </thead>
                                <tr>
                                    <td class="centered-column">1</td>
                                    <td class="content-column">Pengajuan Bimbingan Kerja Praktek</td>
                                    <td class="centered-column">05 April 2024</td>
                                    <td class="centered-column">
                                        <button type="status" class="btn btn-danger rounded-5">ditolak
                                            <i class="fas fa- icon-dark-acc"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="centered-column">2</td>
                                    <td class="content-column">Pengajuan Bimbingan Kerja Praktek</td>
                                    <td class="centered-column">30 April 2024</td>
                                    <td class="centered-column">
                                        <button type="status" class="btn btn-success rounded-5">diterima
                                            <i class="fas  icon-dark-acc"></i>
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>

@endsection
