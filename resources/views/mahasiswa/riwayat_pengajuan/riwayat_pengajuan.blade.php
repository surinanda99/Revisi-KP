@extends('mahasiswa.layouts.main')
@section('title', 'Daftar Riwayat Pengajuan')
@section('content')
<main>
    <div class="container-border mb-5">
        <h4 class="mb-4">Riwayat Pengajuan Dosbing</h4>
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-header bg-primary text-white">
                    <tr>
                        <th class="align-middle text-center">No.</th>
                        <th class="align-middle">NPP Dosen</th>
                        <th class="align-middle">Nama Dosen</th>
                        <th class="align-middle">Email Dosen</th>
                        <th class="align-middle">Judul Pengajuan</th>
                        <th class="align-middle">Alasan</th>
                        <th class="align-middle text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="centered-column text-center">1</td>
                        <td class="centered-column">0686.11.2012.444</td>
                        <td class="centered-column">ADHITYA NUGRAHA, S.Kom, M.CS</td>
                        <td class="centered-column">adhitya@dsn.dinus.ac.id</td>
                        <td class="centered-column">Sentimen Analysis Komentar Baik pada Shopee</td>
                        <td class="centered-column">Melanjutkan ke Logbook</td>
                        <td class="centered-column text-center">
                            <button type="button" class="btn btn-success rounded-pill">Diterima</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="centered-column text-center">2</td>
                        <td class="centered-column">0686.11.2012.444</td>
                        <td class="centered-column">ADHITYA NUGRAHA, S.Kom, M.CS</td>
                        <td class="centered-column">adhitya@dsn.dinus.ac.id</td>
                        <td class="centered-column">Sentimen Analysis Komentar Jahat pada Aplikasi X</td>
                        <td class="centered-column">Judul Pasaran</td>
                        <td class="centered-column text-center">
                            <button type="button" class="btn btn-danger rounded-pill">Ditolak</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <nav aria-label="pageNavigationLogbook">
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="container-border">
        <h4 class="mb-4">Riwayat Pengajuan Review Penyelia</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-header bg-primary text-white">
                    <tr>
                        <th class="align-middle text-center">No.</th>
                        <th class="align-middle">NPP Dosen</th>
                        <th class="align-middle">Dosen Pembimbing</th>
                        <th class="align-middle">Nama Penyelia</th>
                        <th class="align-middle">Perusahaan</th>
                        <th class="align-middle text-center">File</th>
                        <th class="align-middle text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="centered-column text-center">1</td>
                        <td class="centered-column">0686.11.2012.444</td>
                        <td class="centered-column">ADHITYA NUGRAHA, S.Kom, M.CS</td>
                        <td class="centered-column">Mr. A</td>
                        <td class="centered-column">ABCD</td>
                        <td class="centered-column text-center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogDetailRiwayat">
                                <i class="fas fa-file-alt"></i>
                            </button>
                        </td>
                        <td class="centered-column text-center">
                            <button type="button" class="btn btn-success rounded-pill">Diterima</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <nav aria-label="pageNavigationLogbook">
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</main>

<!--Dialog detail riwayat pengajuan-->
@include('mahasiswa.riwayat_pengajuan.detail_riwayat')
@endsection
