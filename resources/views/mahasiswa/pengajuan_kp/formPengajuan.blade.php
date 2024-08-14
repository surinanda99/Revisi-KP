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
            <div id="nav-tab-pengajuan" class="tab-pane fade show active">
                <div class="container">
                    <h4 class="mb-4">Pengajuan Kerja Praktek</h4>
                    <blockquote class="blockquote-primary">
                        <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
                    </blockquote>
                    <form action="{{ route('draft-pengajuan-mahasiswa') }}" method="GET">
                        @csrf
                        <input type="hidden" name="id_dospem" value="{{ $data['id_dsn'] }}">
                        <!-- jalur KP -->
                        <div class="form-group row mb-3">
                            <label for="inputBidang" class="col-sm-2 col-form-label">Kategori Bidang <span
                                    class="required">*</span></label>
                            <div class="col-sm-3">
                                <select class="form-select" name="kategori_bidang" id="inputBidang"
                                    aria-label="Bidang Kajian">
                                    @if ($data['kategori_bidang'] == 'Web_Development')
                                        <option disabled hidden>Pilih Bidang</option>
                                        <option selected value="Web_Development">Web Development</option>
                                        <option value="Application_Development">Application Development</option>
                                        <option value="Game_Development">Game Development</option>
                                        <option value="Data_Analysis">Data Analysis</option>
                                        <option value="Artificial_Intelligence">Artificial Intelligence</option>
                                    @elseif ($data['kategori_bidang'] == 'Application_Development')
                                        <option disabled hidden>Pilih Bidang</option>
                                        <option selected value="Web_Development">Web Development</option>
                                        <option value="Application_Development">Application Development</option>
                                        <option value="Game_Development">Game Development</option>
                                        <option value="Data_Analysis">Data Analysis</option>
                                        <option value="Artificial_Intelligence">Artificial Intelligence</option>
                                    @elseif ($data['kategori_bidang'] == 'Game_Development')
                                    <option disabled hidden>Pilih Bidang</option>
                                        <option selected value="Web_Development">Web Development</option>
                                        <option value="Application_Development">Application Development</option>
                                        <option value="Game_Development">Game Development</option>
                                        <option value="Data_Analysis">Data Analysis</option>
                                        <option value="Artificial_Intelligence">Artificial Intelligence</option>
                                    @elseif ($data['kategori_bidang'] == 'Data_Analysis')
                                        <option disabled hidden>Pilih Bidang</option>
                                        <option selected value="Web_Development">Web Development</option>
                                        <option value="Application_Development">Application Development</option>
                                        <option value="Game_Development">Game Development</option>
                                        <option value="Data_Analysis">Data Analysis</option>
                                        <option value="Artificial_Intelligence">Artificial Intelligence</option>
                                    @elseif ($data['kategori_bidang'] == 'Artificial_Intelligence')
                                        <option disabled hidden>Pilih Bidang</option>
                                        <option selected value="Web_Development">Web Development</option>
                                        <option value="Application_Development">Application Development</option>
                                        <option value="Game_Development">Game Development</option>
                                        <option value="Data_Analysis">Data Analysis</option>
                                        <option value="Artificial_Intelligence">Artificial Intelligence</option>
                                    @else
                                        <option disabled selected>Pilih Bidang Kajian</option>
                                        <option value="Web_Development">Web Development</option>
                                        <option value="Application_Development">Application Development</option>
                                        <option value="Game_Development">Game Development</option>
                                        <option value="Data_Analysis">Data Analysis</option>
                                        <option value="Artificial_Intelligence">Artificial Intelligence</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputJudul" class="col-sm-2 col-form-label">Judul<span
                                    class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="judul" name="judul" class="form-control" id="inputJudul"
                                    placeholder="Masukkan Judul KP" value="{{ $data['judul'] }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputPerusahaan" class="col-sm-2 col-form-label">Perusahaan</label>
                            <div class="col-sm-10">
                                <input type="perusahaan" name="perusahaan" class="form-control" id="inputPerusahaan"
                                    placeholder="Masukkan Nama Perusahaan" value="{{ $data['perusahaan'] }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputPosisi" class="col-sm-2 col-form-label">Posisi</label>
                            <div class="col-sm-10">
                                <input type="posisi" name="posisi" class="form-control" id="inputPosisi"
                                    placeholder="Masukkan Posisi" value="{{ $data['posisi'] }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi<span
                                    class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="deskripsi" name="deskripsi" class="form-control" id="inputDeskripsi"
                                    placeholder="Masukkan Deskripsi" value="{{ $data['deskripsi'] }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputDurasi" class="col-sm-2 col-form-label">Durasi</label>
                            <div class="col-sm-10">
                                <input type="durasi" name="durasi" class="form-control" id="inputDurasi"
                                    placeholder="Masukkan Durasi Kerja Praktek" value="{{ $data['durasi'] }}">
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-end">
                            <div class="col-sm-1 d-flex justify-content-end">
                                <a href="{{ route('pengajuan-mahasiswa') }}" class="btn btn-secondary me-2">Kembali</a>
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection





