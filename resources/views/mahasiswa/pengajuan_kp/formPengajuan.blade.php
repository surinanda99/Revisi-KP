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







{{-- @extends('mahasiswa.layouts.main')
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

    @if (Session::get('error'))
        <div class="row">
            <div class="col-md-4 offset-4 mt-2 py-2 rounded bg-danger text-white fw-bold">
                {{ Session::get('error') }}
            </div>
        </div>
    @endif
    
    <div class="tab-content">
        <div id="nav-tab-pengajuan" class="tab-pane fade show active">
            <div class="container">
                <h4 class="mb-4">Pengajuan Kerja Praktek</h4>
                <blockquote class="blockquote-primary">
                    <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
                </blockquote>
            </div>
            <div class="container">
                <form action="{{ route('SimpanPengajuan') }}" method="POST">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="kategori_bidang" class="col-sm-2 col-form-label">Kategori Bidang <span class="required">*</span></label>
                        <div class="col-sm-3">
                            <select class="form-select form-control @error('kategori_bidang') is-invalid @enderror" name="kategori_bidang" id="kategori_bidang" aria-label="Bidang Kajian">
                                <option selected value="0">Pilih Bidang</option>
                                <option value="Web Development" {{ old('kategori_bidang') === 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                <option value="Application Development {{ old('kategori_bidang') === 'Application Development' ? 'selected' : '' }}">Application Development</option>
                                <option value="Game Development" {{ old('kategori_bidang') === 'Game Development' ? 'selected' : '' }}>Game Development</option>
                                <option value="Data Analysis" {{ old('kategori_bidang') === 'Data Analysis' ? 'selected' : '' }}>Data Analysis</option>
                                <option value="Data Science" {{ old('kategori_bidang') === 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                <option value="Artificial Intelligence" {{ old('kategori_bidang') === 'Artificial Intelligence' ? 'selected' : '' }}>Artificial Intelligence</option>
                                <option value="Graphic Design" {{ old('kategori_bidang') === 'Graphic Design' ? 'selected' : '' }}>Graphic Design</option>
                                <option value="Networking" {{ old('kategori_bidang') === 'Networking' ? 'selected' : '' }}>Networking</option>
                            </select>
                            @error('kategori_bidang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="judul" class="col-sm-2 col-form-label">Judul Sementara <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" placeholder="Masukkan Judul Sementara" value="{{ old('judul') }}">
                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="perusahaan" class="col-sm-2 col-form-label">Perusahaan <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('perusahaan') is-invalid @enderror" name="perusahaan" id="perusahaan" placeholder="Masukkan Perusahaan" value="{{ old('perusahaan') }}">
                            @error('perusahaan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="posisi" class="col-sm-2 col-form-label">Posisi <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('posisi') is-invalid @enderror" name="posisi" id="posisi" placeholder="Masukkan Posisi" value="{{ old('posisi') }}">
                            @error('posisi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" rows="3" placeholder="Masukkan Deskripsi">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="durasi" class="col-sm-2 col-form-label">Durasi Magang <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('durasi') is-invalid @enderror" name="durasi" id="durasi" placeholder="Masukkan Durasi" value="{{ old('durasi') }}">
                            @error('durasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3 justify-content-end">
                        <div class="col-sm-1 d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2">Kembali</button>
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection --}}
