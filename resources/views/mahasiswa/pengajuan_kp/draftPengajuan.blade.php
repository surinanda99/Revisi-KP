<!-- draftPengajuan.blade.php -->
@extends('mahasiswa.layouts.main')
@section('title', 'Form Mahasiswa')
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
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link rounded-pill">
                <i class="fas fa-edit"></i>
                Form Pengajuan
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-draft" class="nav-link active rounded-pill">
                <i class="fas fa-book-open"></i>
                Draft Pengajuan
            </a>
        </li>
    </ul>

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

    <div class="tab-content">
        <div id="nav-tab-draft" class="tab-pane fade show active">
            <div class="container mt-5">
                <h4>Pengajuan Bimbingan KP</h4>
                <div class="row mt-5">
                    @if (isset($pengajuan))
                    {{-- {{ dd($pengajuan) }} --}}
                        <form action="{{ route('SimpanPengajuan') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_mhs" value="{{ $pengajuan['id_mhs'] }}">
                            <input type="hidden" name="id_dospem" value="{{ $pengajuan['id_dospem'] }}">
                            <div class="row">
                                <div class="col-2 text-start">
                                    <label for="kategori_bidang" class="form-label">Kategori Bidang</label>
                                </div>
                                <div class="col-10">
                                    <select class="form-select form-control @error('kategori_bidang') is-invalid @enderror" name="kategori_bidang" id="kategori_bidang" aria-label="Bidang Kajian">
                                        <option value="0" {{ !$pengajuan['kategori_bidang'] ? 'selected' : '' }}>Pilih Bidang</option>
                                        <option value="Web Development" {{ $pengajuan['kategori_bidang'] == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                        <option value="Application Development" {{ $pengajuan['kategori_bidang'] == 'Application Development' ? 'selected' : '' }}>Application Development</option>
                                        <option value="Game Development" {{ $pengajuan['kategori_bidang'] == 'Game Development' ? 'selected' : '' }}>Game Development</option>
                                        <option value="Data Analysis" {{ $pengajuan['kategori_bidang'] == 'Data Analysis' ? 'selected' : '' }}>Data Analysis</option>
                                        <option value="Data Science" {{ $pengajuan['kategori_bidang'] == 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                        <option value="Artificial Intelligence" {{ $pengajuan['kategori_bidang'] == 'Artificial Intelligence' ? 'selected' : '' }}>Artificial Intelligence</option>
                                        <option value="Graphic Design" {{ $pengajuan['kategori_bidang'] == 'Graphic Design' ? 'selected' : '' }}>Graphic Design</option>
                                        <option value="Networking" {{ $pengajuan['kategori_bidang'] == 'Networking' ? 'selected' : '' }}>Networking</option>
                                    </select>
                                    @error('kategori_bidang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-2 text-start">
                                    <label for="judul" class="form-label">Judul Sementara</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" value="{{ $pengajuan['judul'] }}">
                                    @error('judul')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-2 text-start">
                                    <label for="perusahaan" class="form-label">Perusahaan</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control @error('perusahaan') is-invalid @enderror" name="perusahaan" id="perusahaan" value="{{ $pengajuan['perusahaan'] }}">
                                    @error('perusahaan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-2 text-start">
                                    <label for="posisi" class="form-label">Posisi</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control @error('posisi') is-invalid @enderror" name="posisi" id="posisi" value="{{ $pengajuan['posisi'] }}">
                                    @error('posisi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-2 text-start">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                </div>
                                <div class="col-10">
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi">{{ $pengajuan['deskripsi'] }}</textarea>
                                    @error('deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4 mb-5">
                                <div class="col-2 text-start">
                                    <label for="durasi" class="form-label">Durasi Magang</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control @error('durasi') is-invalid @enderror" name="durasi" id="durasi" value="{{ $pengajuan['durasi'] }}">
                                    @error('durasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary mt-5 mb-3 me-5" style="width: 100px" type="submit">Submit</button>
                            <a href="{{ route('deletePengajuan') }}" class="btn btn-danger mt-5 mb-3" style="width: 100px">Delete</a>
                        </form>
                    @else
                        <p>Tidak ada pengajuan draft yang ditemukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
