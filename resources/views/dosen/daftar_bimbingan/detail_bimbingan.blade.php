@extends('dosen.layouts.main')
@section('title', 'Detail Mahasiswa Bimbingan')
@section('content')
    <style>
        /* Add some basic styling to make the form look good */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>

    <div class="wrapper d-flex flex-column min-vh-100">
        <div class="container flex-grow-1">
            <img src="https://via.placeholder.com/200x200" alt="Profile" class="image mt-5">
            <div class="form">
                <h2 class="mb-4">Detail Mahasiswa</h2>
                <form action="{{ route('update-mahasiswa-bimbingan', ['id' => $pengajuan->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" value="{{ $mahasiswa->nama }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nim">Nomor Induk Mahasiswa</label>
                        <input type="text" id="nim" value="{{ $mahasiswa->nim }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="kategori-bidang">Kategori Bidang</label>
                        <input type="text" id="kategori-bidang" value="{{ $pengajuan->kategori_bidang }}" class="form-control"
                               disabled>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul Penelitian</label>
                        <input type="text" id="judul" value="{{ $pengajuan->judul }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="perusahaan">perusahaan</label>
                        <input type="text" id="perusahaan" value="{{ $pengajuan->perusahaan }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Umum</label>
                        <input type="text" id="deskripsi" value="{{ $pengajuan->deskripsi }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="durasi">Durasi Magang</label>
                        <input type="text" id="durasi" value="{{ $pengajuan->durasi }}" class="form-control" disabled>
                    </div>
                    @if ($pengajuan->status == 'PENDING')
                        <div style="display: flex; justify-content: flex-end;">
                            <button type="submit" name="status" value="ACC"
                                    class="btn btn-success px-4 py-2 me-2">Setuju</button>
                            <button type="submit" name="status" value="TOLAK" class="btn btn-danger px-4 py-2">Tolak</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- <div class="modal fade" id="dialogDetailPengajuan" tabindex="-1" aria-labelledby="dialogDetailPengajuanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogDetailPengajuanLabel">Detail Pengajuan Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h4 class="mb-4">Pengajuan Kerja Praktek Mahasiswa</h4>
                    <table class="table table-bordered mb-5">
                        <tbody>
                            <tr>
                                <td>Kategori Bidang</td>
                                <td>Data Science</td>
                            </tr>
                            <tr>
                                <td>Judul Sementara</td>
                                <td>sentimen pengguna aplikasi</td>
                            </tr>
                            <tr>
                                <td>Perusahaan</td>
                                <td>a</td>`
                            </tr>
                            <tr>
                                <td>Posisi</td>
                                <td>b</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>b</td>
                            </tr>
                            <tr>
                                <td>Durasi Magang</td>
                                <td>b</td>
                            </tr>
                            {{-- <tr>
                                <td>Dokumen</td>
                                <td><a href="https://github.com/eiffelputri" target="_blank">https://github.com/eiffelputri</a></td>
                            </tr> --}}
                        {{-- </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success">Terima</button>
                    <button type="button" class="btn btn-danger">Tolak</button>
                </div>
            </div>
        </div>
    </div>
</div> --}} 