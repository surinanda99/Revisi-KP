@extends('mahasiswa.layouts.main')
@section('title', 'Pengajuan Sidang KP')
@section('content')
    <div class="container">
        <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
            <li class="nav-item">
                <a data-toggle="pill" class="nav-link active rounded-pill">
                    <i class="far fa-calendar-check"></i>
                    Jadwal Sidang
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="pill" class="nav-link rounded-pill">
                    <i class="fas fa-edit"></i>
                    Form Pengajuan
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="pill" class="nav-link rounded-pill">
                    <i class="fas fa-book-open"></i>
                    Draft Pengajuan
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="nav-tab-jadwal" class="tab-pane fade show active">
                <div class="container">
                    <h4 class="mb-4">Pemilihan Jadwal Sidang</h4>
                    
                        <div class="alert alert-danger" role="alert">
                            Anda belum menyelesaikan bab 3, silahkan selesaikan terlebih dahulu lalu update logbook terbaru
                            anda.
                        </div>
                    
                        {{-- <p class="mb-2">Berikut ini adalah daftar sidang yang tersedia</p>
                        <blockquote class="blockquote-primary">
                            <p class="mb-3">Klik tombol panah <button type="button" class="btn btn-warning"><i
                                        class="fas fa-chevron-circle-right"></i></button> untuk memilih jadwal sidang</p>
                        </blockquote>
                        <div class="input-group justify-content-end mb-3">
                            <input type="text" class="form-control" placeholder="Cari Jadwal">
                            <div class="input-group-append"><button class="btn btn-primary"><i
                                        class="fas fa-search"></i></button></div>
                        </div>
                        <div class="table-container table-jadwal">
                            <table class="table table-bordered mb-1">
                                <thead class="table-header">
                                    <th>No</th>
                                    <th>Periode</th>
                                    <th>Pendaftaran Sidang</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </thead>
                                <tr>
                                    <td class="centered-column">1</td>
                                    <td class="centered-column">April</td>
                                    <td class="centered-column">1 April 2024 - 30 April 2024</td>
                                    <td class="centered-column">Tersedia</td>
                                    <td class="centered-column"><button type="button" class="btn btn-warning"
                                            data-bs-toggle="modal" data-bs-target="#pilihJadwalModal"><i
                                                class="fas fa-chevron-circle-right"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="centered-column">1</td>
                                    <td class="centered-column">Mei</td>
                                    <td class="centered-column">1 Mei 2024 - 30 Mei 2024</td>
                                    <td class="centered-column">Belum Tersedia</td>
                                    <td class="centered-column"><button type="button" class="btn btn-warning"
                                            data-bs-toggle="modal" data-bs-target="#pilihJadwalModal"><i
                                                class="fas fa-chevron-circle-right"></i></button></td>
                                </tr>
                            </table>
                        </div>
                        <nav aria-label="pageNavigationJadwal">
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
                        </nav> --}}

                </div>

                <!-- Modal Pilih Dosbing -->
                <div class="modal fade" id="pilihJadwalModal" tabindex="-1" aria-labelledby="pilihJadwalModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pilihJadwalModalLabel">Pilih Jadwal Sidang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Yakin untuk memilih jadwal sidang ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                <button type="button" class="btn btn-primary">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Hapus Dosbing -->
                <div class="modal fade" id="hapusJadwalModal" tabindex="-1" aria-labelledby="hapusJadwalModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusJadwalModalLabel">Hapus Jadwal Sidang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Yakin untuk menghapus jadwal sidang ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                <button type="button" class="btn btn-primary">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
