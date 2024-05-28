@extends('mahasiswa.layouts.main')
@section('title', 'Pengajuan TA')
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
            @include('mahasiswa.pengajuan_kp.pilihDosbing')
        </div>
        <div id="nav-tab-pengajuan" class="tab-pane fade">
            @include('mahasiswa.pengajuan_kp.formPengajuan')
        </div>
        <div id="nav-tab-draft" class="tab-pane fade">
            @include('mahasiswa.pengajuan_kp.draftPengajuan')
        </div>
    </div>
</div>
@endsection