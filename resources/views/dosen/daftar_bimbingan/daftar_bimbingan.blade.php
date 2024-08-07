@extends('dosen.layouts.main')
@section('title', 'Daftar Bimbingan Kerja Praktek')
@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="wrapper d-flex flex-column min-vh-100">
    <div class="container flex-grow-1">
        <h3 class="mb-3"><b>Daftar Pengajuan Mahasiswa Bimbingan</b></h3>
        <p class="mb-2">Berikut ini adalah daftar pengajuan mahasiswa bimbingan</p>
        <div class="input-group justify-content-end mb-3">
            <input class="form-control" type="text" placeholder="Search here..." aria-label="Search for..."
                   aria-describedby="btnNavbarSearch" />
            <button class="btn" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
        <div class="table-container table-dosbing">
            <table class="table table-bordered mb-1">
                <thead class="table-header">
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Foto</th>
                <th>IPK</th>
                <th>Judul</th>
                <th>Status</th>
                </thead>
                @foreach ($pengajuan as $pj)
                        <tr class="centered-column">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pj->mahasiswa->nim }}</td>
                            <td>{{ $pj->mahasiswa->nama }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="{{ $pj->mahasiswa->id }}">
                                    <i class="fa-solid fa-images"></i>
                                </button>
                            </td>
                            <td>{{ $pj->mahasiswa->ipk }}</td>
                            <td>{{ $pj->judul }}</td>
                            {{-- <td class="centered-column">
                                <form action="{{ route('update-mahasiswa-bimbingan') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $pj->id }}">
                                    <button type="submit" name="status" class="btn btn-success" value="ACC">
                                        <i class="fa-regular fa-circle-check"></i> ACC
                                    </button>
                                    <button type="submit" name="status "class="btn btn-danger delete-button" value="TOLAK" id="rejectButton_{{ $pj->id }}">
                                        <i class="fa-regular fa-circle-xmark"></i> TOLAK
                                    </button>
                                </form>
                            </td> --}}
                            <td class="centered-column">
                                @if ($pj->status == 'ACC')
                                    <button class="btn btn-success" value="ACC">
                                        Status Diterima
                                    </button>
                                @elseif ($pj->status == 'TOLAK')
                                    Status Ditolak
                                @else
                                    <form action="{{ route('update-mahasiswa-bimbingan') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $pj->id }}">
                                        <button type="submit" name="status" class="btn btn-success" value="ACC">
                                            <i class="fa-regular fa-circle-check"></i> ACC
                                        </button>
                                        <button type="submit" name="status" class="btn btn-danger delete-button" value="TOLAK" id="rejectButton_{{ $pj->id }}">
                                            <i class="fa-regular fa-circle-xmark"></i> TOLAK
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                {{-- <tr class="centered-column">
                    <td>2</td>
                    <td>A11.2021.13800</td>
                    <td>Nikolas Adi Kurniatmaja Sijabat</td>
                    <td>
                        <a href="#" class="btn btn-warning"><i class="fa-solid fa-images"></i></a>
                    </td>
                    <td>3.84</td>
                    <td>Sentimen Analysis</td>
                    <td class="centered-column">
                        <button type="submit" name="status" class="btn btn-success" value="ACC"><i
                                class="fa-regular fa-circle-check"></i></button>
                        <button type="submit" name="status" class="btn btn-danger delete-button" value="REVISI"><i
                                class="fa-regular fa-circle-xmark"></i></button>
                    </td>
                </tr> --}}
            </table>
        </div>
        {{-- {{ $pengajuan->links() }} --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var deleteButtons = document.querySelectorAll('.delete-button');
                deleteButtons.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        Swal.fire({
                            title: 'Pengajuan ingin ditolak?',
                            text: "Pengajuan ditolak tidak dapat dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, tolak!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Proses penghapusan data di sini
                                Swal.fire(
                                    'Success!',
                                    'Pengajuan berhasil ditolak',
                                    'success'
                                );
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                // Batalkan penghapusan
                                Swal.fire(
                                    'Canceled!',
                                    'Pengajuan gagal ditolak',
                                    'error'
                                );
                            }
                        });
                    });
                });
            });
        </script>
    @endsection




{{-- @extends('dosen.layouts.main')
@section('title', 'Daftar Bimbingan Kerja Praktek')
@section('content')
<div class="container">
    <h4 class="mb-4">Daftar Bimbingan Mahasiswa Kerja Praktek</h4>

    <p class="mb-2 d-flex justify-content-between align-items-center">
        Berikut merupakan daftar bimbingan mahasiswa
    </p>
    <blockquote class="blockquote-primary">
        <p class="mb-3">Klik tombol <button type="button" class="btn btn-primary"><i class="fas fa-info-circle"></i></button> untuk melihat detail pengajuan mahasiswa</p>
    </blockquote>
    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <th class="align-middle">No.</th>
                <th class="align-middle">NIM</th>
                <th class="align-middle">Nama Mahasiswa</th>
                <th class="align-middle">IPK</th>
                <th class="align-middle">Detail</th>
                <th class="align-middle">Status</th>
            </thead>
            </thead>
            <tr>
                <td class="centered-column">1</td>
                <td class="centered-column">A11.2021.13489</td>
                <td class="centered-column">Surinanda</td>
                <td class="centered-column">4.00</td>
                <td class="centered-column">
                    <button type="info" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogDetailPengajuan"><i class="fas fa-info-circle"></i></button>
                </td>
                <td class="centered-column">
                    <button type="status" class="btn btn-success rounded-5">diterima</button>
            </tr>
            <tr>
                <td class="centered-column">2</td>
                <td class="centered-column">A11.2021.13472</td>
                <td class="centered-column">Yoga Adi Pratama</td>
                <td class="centered-column">4.00</td>
                <td class="centered-column">
                    <button type="info" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogDetailPengajuan"><i class="fas fa-info-circle"></i></button>
                </td>
                <td class="centered-column">
                    <button type="status" class="btn btn-danger rounded-5">ditolak</button>
            </tr>
            <tr>
                <td class="centered-column">3</td>
                <td class="centered-column">A11.2021.13800</td>
                <td class="centered-column">Nikolas Adi Kurniatmaja Sijabat</td>
                <td class="centered-column">4.00</td>
                <td class="centered-column">
                    <button type="info" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogDetailPengajuan"><i class="fas fa-info-circle"></i></button>
                </td>
                <td class="centered-column">
                    <button type="status" class="btn btn-warning rounded-5">on process</button>
            </tr>
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
    <!--
    <button type="submit" class="btn btn-primary"><i class="fas fa-chevron-right"></i>Pengajuan Sidang</button>
    -->
</div>

<!--Dialog Tambah Logbook-->
@include('dosen.daftar_bimbingan.detail_bimbingan')

@endsection --}}
