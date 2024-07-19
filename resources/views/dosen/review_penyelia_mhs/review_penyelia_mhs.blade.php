@extends('dosen.layouts.main')
@section('title', 'Daftar Review Penyelia')
@section('content')
<div class="container">
    <h4 class="mb-4">Review Penilaian Penyelia Mahasiswa Kerja Praktek</h4>

    <p class="mb-2 d-flex justify-content-between align-items-center">
        <blockquote class="blockquote-primary">
            <p class="mb-3">Klik tombol <button type="button" class="btn btn-primary"><i class="lni lni-empty-file"></i></button> untuk melihat detail Review Penyelia mahasiswa</p>
        </blockquote>
        Berikut merupakan daftar Detail Penilaian Mahasiswa
    </p>
    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <th class="align-middle">No.</th>
                <th class="align-middle">NIM</th>
                <th class="align-middle">Nama Mahasiswa</th>
                <th class="align-middle">Review Penyelia</th>
                {{-- <th class="align-middle">Prestasi dan Kontribusi</th>
                <th class="align-middle">Keterampilan dan Kemampuan</th>
                <th class="align-middle">Kerjasama Dan Keterlibatan</th>
                <th class="align-middle">Komentar</th>
                <th class="align-middle">Perkembangan</th>
                <th class="align-middle">Kesimpulan Dan Saran</th>
                <th class="align-middle">Score</th>
                <th class="align-middle">File</th> --}}
                <th class="align-middle">Aksi</th>
            </thead>
            {{-- <tr>
                <td class="centered-column">1</td>
                <td class="centered-column">A11.2021.13489</td>
                <td class="centered-column">Surinanda</td>
                <td class="centered-column"></td>
                <td class="centered-column"></td>
                <td class="centered-column">
                    <button type="info" class="btn btn-secondary"><i class="fas fa-lock"></i></button>
                    <button type="info" class="btn btn-info"><i class="fas fa-unlock"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="centered-column">2</td>
                <td class="centered-column">A11.2021.13800</td>
                <td class="centered-column">Nikolas Adi Kurniatmaja Sijabat</td>
                <td class="centered-column"><button type="button" class="btn btn-primary"><i class="lni lni-empty-file"></i></td>
                <td class="centered-column"><a href="https://drive.google.com/drive/folders/1NSgwE4CEOqnPBZrfcoIu7wSFYuvvCu-O?usp=drive_link" target="_blank">Dokumen</a></td>
                <td class="centered-column">
                    <button type="info" class="btn btn-info"><i class="fas fa-lock"></i></button>
                    <button type="info" class="btn btn-secondary"><i class="fas fa-unlock"></i></button>
                </td>
            </tr> --}}
            <tbody>

                <!-- Loop untuk Menampilkan Setiap Data Mahasiswa -->
                @foreach
                
                @endforeach
                {{-- @foreach($detail_penilaians as $review)
                <tr>
                    <td class="centered-column">{{ $loop->iteration }}</td>
                    <td class="centered-column">{{ $review->mahasiswa_id }}</td>
                    <td class="centered-column">{{ $review->penyelia_id }}</td>
                    <td class="centered-column">{{ $review->deskripsi_pekerjaan }}</td>
                    <td class="centered-column">{{ $review->prestasi_kontribusi }}</td>
                    <td class="centered-column">{{ $review->keterampilan_kemampuan }}</td>
                    <td class="centered-column">{{ $review->kerjasama_keterlibatan }}</td>
                    <td class="centered-column">{{ $review->komentar }}</td>
                    <td class="centered-column">{{ $review->perkembangan }}</td>
                    <td class="centered-column">{{ $review->kesimpulan_saran }}</td>
                    <td class="centered-column">{{ $review->score }}</td>
                    <td class="centered-column">{{ $review->file_path }}</td>
                    <td class="centered-column">
                        <button type="info" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#dialogDetailDataMahasiswa" ><i class="fas fa-info-circle"></i></button>
                        <button class="btn btn-warning me-1 btn-edit" data-id="{{ $review->id }}" data-bs-toggle="modal" data-bs-target="#dialogEditMhs_{{ $review->id }}">
                            <i class="far fa-edit"></i>
                        </button>
                        <form action="{{ route('hapusMhs', ['id' => $review->id]) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
    <nav aria-label="pageNavigationReviewPenyelia">
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
    <!--
    <button type="submit" class="btn btn-primary"><i class="fas fa-chevron-right"></i>Pengajuan Sidang</button>
    -->
</div>

<!--Dialog Detail Logbook-->
@include('dosen.logbook_bimbingan.detail_logbook')
@endsection
