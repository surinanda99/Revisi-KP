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

    <div class="tab-content">
        <div id="nav-tab-draft" class="tab-pane fade show active">
            <div class="container">
                <h4 class="mb-4">Pengajuan Kerja Praktek Ke-1</h4>
                @if ($data)
                    <blockquote class="blockquote-primary">
                        <p class="mb-3"><b>Status: Draft</b> - Untuk mengajukan tugas akhir ke dosen pembimbing,
                            klik
                            tombol Ajukan di bawah</p>
                    </blockquote>
                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td>Bidang Kajian</td>
                            <td>{{ $data['kategori_bidang'] }}</td>
                        </tr>
                        <tr>
                            <td>Judul</td>
                            <td>{{ $data['judul'] }}</td>
                        </tr>
                        <tr>
                            <td>Perusahaan</td>
                            <td>{{ $data['perusahaan'] }}</td>
                        </tr>
                        <tr>
                            <td>Posisi</td>
                            <td>{{ $data['posisi'] }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>{{ $data['deskripsi'] }}</td>
                        </tr>
                        <tr>
                            <td>Durasi</td>
                            <td>{{ $data['durasi'] }}</td>
                        </tr>
                        <tr>
                            <td>Usulan Dosen Pembimbing</td>
                            <td>{{ $dospil->nama }}</td>
                        </tr>
                        </tbody>
                    </table>
                @else
                    @if ($pengajuan->status == 'PENDING')
                        <blockquote class="blockquote-pengajuan">
                            <p class="mb-3"><b>Status: Pengajuan</b> - Proposal telah diajukan pada tanggal
                                [{{ $pengajuan->created_at }} WIB] </p>
                        </blockquote>
                    @else
                        <blockquote class="blockquote-primary">
                            <p class="mb-3"><b>Status: Disetujui</b> - Untuk tahap selanjutnya, silahkan melakukan
                                bimbingan
                                dengan dosen pembimbing dengan melakukan pengisian logbook bimbingan </p>
                        </blockquote>
                    @endif
                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td>Bidang Kajian</td>
                            <td>{{ $pengajuan->kategori_bidang }}</td>
                        </tr>
                        <tr>
                            <td>Judul</td>
                            <td>{{ $pengajuan->judul }}</td>
                        </tr>
                        <tr>
                            <td>Perusahaan</td>
                            <td>{{ $pengajuan->perusahaan }}</td>
                        </tr>
                        <tr>
                            <td>Posisi</td>
                            <td>{{ $pengajuan->posisi }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>{{ $pengajuan->deskripsi }}</td>
                        </tr>
                        <tr>
                            <td>Durasi</td>
                            <td>{{ $pengajuan->durasi }}</td>
                        </tr>
                        <tr>
                            <td>Usulan Dosen Pembimbing</td>
                            <td>{{ $dospil->nama }}</td>
                        </tr>
                        </tbody>
                    </table>
                @endif

                @if (count($history) > 0)
                    <p class="mb-2">Histori Penolakan Pengajuan Tugas Akhir</p>
                    <div class="table-container table-tolak">
                        <table class="table table-bordered">
                            <thead class="table-header">
                            <th>Tanggal Pengajuan</th>
                            <th>Dosen Ajuan</th>
                            </thead>
                            @foreach ($history as $hs)
                                <tr>
                                    <td class="centered-column">{{ $hs->created_at }}</td>
                                    <td class="alasan-column">{{ $hs->dosen->nama }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                @endif

                @if ($data)
                    <div class="form-group row mb-3 justify-content-end"></div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('pengajuan-mahasiswa') }}" class="btn btn-danger me-2">Hapus</a>
                        <form action="{{ route('form-pengajuan-mahasiswa') }}" method="GET">
                            @csrf
                            <input type="hidden" name="kategori_bidang" value="{{ $data['kategori_bidang'] }}">
                            <input type="hidden" name="judul" value="{{ $data['judul'] }}">
                            <input type="hidden" name="perusahaan" value="{{ $data['perusahaan'] }}">
                            <input type="hidden" name="posisi" value="{{ $data['posisi'] }}">
                            <input type="hidden" name="deskripsi" value="{{ $data['deskripsi'] }}">
                            <input type="hidden" name="durasi" value="{{ $data['durasi'] }}">
                            <input type="hidden" name="id_dsn" value="{{ $data['id_dospem'] }}">
                            <button type="submit" class="btn btn-warning me-2">Edit</button>
                        </form>
                        <form action="{{ route('mahasiswa-pengajuan-submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kategori_bidang" value="{{ $data['kategori_bidang'] }}">
                            <input type="hidden" name="judul" value="{{ $data['judul'] }}">
                            <input type="hidden" name="perusahaan" value="{{ $data['perusahaan'] }}">
                            <input type="hidden" name="posisi" value="{{ $data['posisi'] }}">
                            <input type="hidden" name="deskripsi" value="{{ $data['deskripsi'] }}">
                            <input type="hidden" name="durasi" value="{{ $data['durasi'] }}">
                            <input type="hidden" name="id_dsn" value="{{ $data['id_dospem'] }}">
                            <button type="submit" class="btn btn-primary me-2">Ajukan</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection




{{-- <!-- draftPengajuan.blade.php -->
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
                        {{-- <form action="{{ route('updatePengajuan') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-2 text-start">
                                    <label for="kategori_bidang" class="form-label">Kategori Bidang</label>
                                </div>
                                <div class="col-10">
                                    <select class="form-select form-control @error('kategori_bidang') is-invalid @enderror" name="kategori_bidang" id="kategori_bidang" aria-label="Bidang Kajian">
                                        <option value="0" {{ !$pengajuan->kategori_bidang ? 'selected' : '' }}>Pilih Bidang</option>
                                        <option value="Web Development" {{ $pengajuan->kategori_bidang == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                        <option value="Application Development" {{ $pengajuan->kategori_bidang == 'Application Development' ? 'selected' : '' }}>Application Development</option>
                                        <option value="Game Development" {{ $pengajuan->kategori_bidang == 'Game Development' ? 'selected' : '' }}>Game Development</option>
                                        <option value="Data Analysis" {{ $pengajuan->kategori_bidang == 'Data Analysis' ? 'selected' : '' }}>Data Analysis</option>
                                        <option value="Data Science" {{ $pengajuan->kategori_bidang == 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                        <option value="Artificial Intelligence" {{ $pengajuan->kategori_bidang == 'Artificial Intelligence' ? 'selected' : '' }}>Artificial Intelligence</option>
                                        <option value="Graphic Design" {{ $pengajuan->kategori_bidang == 'Graphic Design' ? 'selected' : '' }}>Graphic Design</option>
                                        <option value="Networking" {{ $pengajuan->kategori_bidang == 'Networking' ? 'selected' : '' }}>Networking</option>
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
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" value="{{ $pengajuan->judul }}">
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
                                    <input type="text" class="form-control @error('perusahaan') is-invalid @enderror" name="perusahaan" id="perusahaan" value="{{ $pengajuan->perusahaan }}">
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
                                    <input type="text" class="form-control @error('posisi') is-invalid @enderror" name="posisi" id="posisi" value="{{ $pengajuan->posisi }}">
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
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi">{{ $pengajuan->deskripsi }}</textarea>
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
                                    <input type="text" class="form-control @error('durasi') is-invalid @enderror" name="durasi" id="durasi" value="{{ $pengajuan->durasi }}">
                                    @error('durasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary mt-5 mb-3 me-5" style="width: 100px" type="submit">Update</button>
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
@endsection --}} 
