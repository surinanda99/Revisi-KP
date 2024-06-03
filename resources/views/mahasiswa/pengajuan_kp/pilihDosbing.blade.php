@extends('mahasiswa.layouts.main')
@section('title', 'Pilih Dosen Pembimbing')
@section('content')
<div class="container">
    <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-dosbing" class="nav-link active rounded-pill">
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
            <a data-toggle="pill" href="#nav-tab-draft" class="nav-link rounded-pill">
                <i class="fas fa-book-open"></i>
                Draft Pengajuan
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="nav-tab-dosbing" class="tab-pane fade show active">
            <div class="container">
                <h4 class="mb-4">Pemilihan Dosen Pembimbing</h4>  
                <p class="mb-2">Berikut ini adalah daftar dosen pembimbing yang tersedia</p>
                <blockquote class="blockquote-primary">
                    <p class="mb-3">Klik tombol panah <button type="button" class="btn btn-warning"><i class="fas fa-chevron-circle-right"></i></button> untuk memilih dosen pembimbing</p>
                </blockquote>
                <form action="{{ route('pilihDosen') }}" method="POST">
                    @csrf
                    <div class="table-container table-dosbing">
                        <table class="table table-bordered mb-1">
                            <thead class="table-header">
                                <th>No</th>
                                <th>NIDN</th>
                                <th>Nama Dosen</th>
                                <th>Sisa Kuota</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($dosens as $dosen)
                                    <tr>
                                        <td class="centered-column">{{ $loop->iteration }}</td>
                                        <td class="centered-column">{{ $dosen->nidn }}</td>
                                        <td>{{ $dosen->nama }}</td>
                                        <td class="centered-column">{{ $dosen->sisa_kuota }}</td>
                                        <td class="centered-column">
                                            <button type="submit" name="dosen_id" value="{{ $dosen->id }}" class="btn btn-warning"><i class="fas fa-chevron-circle-right"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
