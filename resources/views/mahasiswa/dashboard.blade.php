@extends('mahasiswa.layouts.main')
@section('title', 'Dashboard Mahasiswa')
@section('content')
<div class="container-dashboard">
    <h1>Hi,</h1>
    <div class="type">
        <h1></h1>
    </div>
    <p>Siap untuk kerja praktek hari ini?</p>
</div>
<main class="container-border">
    <div class="container">
        <form>
            <h4 class="text-center">Lengkapi Data Diri</h4>
            <hr>
            <div class="form-group row mb-3">
                <label for="inputTelp" class="col-sm-2 col-form-label">Nomor Telepon <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTelp" name="telp" placeholder="Masukkan Nomor Telepon" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputIPK" class="col-sm-2 col-form-label">IPK <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputIPK" name="ipk" placeholder="Masukkan IPK" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputTranskrip" class="col-sm-2 col-form-label">Upload Link Transkrip Nilai <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTranskrip" name="transkrip" placeholder="Masukkan Link Transkrip" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <div class="col-sm-10 offset-sm-2 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        {{-- @if ($status->id_dsn == 0)
            <div class="alert alert-warning" role="alert">
                Anda belum memiliki dosen pembimbing. Silahkan melakukan pengajuan TA terlebih dahulu.
            </div>
            <a href="" class="btn btn-primary"><i class="fas fa-chevron-right"></i>Pengajuan Dosen Pembimbing</a>
        @else --}}
            <!-- Closing div added here -->
    </div>
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
                                <!--
                                <button type="status" class="btn btn-danger rounded-5">Belum ACC
                                    <i class="fas fa-times icon-dark-no"></i>
                                </button>
                                -->
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
                                <!--
                                <button type="status" class="btn btn-danger rounded-5">Belum ACC
                                    <i class="fas fa-times icon-dark-no"></i>
                                </button>
                                -->
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- Closing div added here -->
    </div>
    {{-- @endif --}}
</main>

@endsection
