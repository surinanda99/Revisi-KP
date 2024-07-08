@extends('dosen.layouts.main')
@section('title', 'Daftar Pengajuan Sidang')
@section('content')
<div class="wrapper d-flex flex-column min-vh-100">
    <div class="container flex-grow-1">
        <h3 class="mb-3"><b>Daftar Pengajuan Sidang Mahasiswa</b></h3>
        <p class="mb-2">Berikut ini adalah daftar pengajuan Sidang Mahasiswa Kerja Praktek</p>
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
                <th>Nilai Penyelia</th>
                <th>Nilai Pembimbing</th>
                <th>Nilai Penguji</th>
                <th>Waktu Sidang</th>
                </thead>
                {{-- @foreach ($pengajuan as $pj)
                        <tr class="centered-column">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pj->mahasiswa->mahasiswa->nim }}</td>
                            <td>{{ $pj->mahasiswa->mahasiswa->nama }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="{{ $pj->mahasiswa->mahasiswa->id }}">
                                    <i class="fa-solid fa-images"></i>
                                </button>
                            </td>
                            <td>{{ $pj->mahasiswa->mahasiswa->ipk }}</td>
                            <td>{{ $pj->topik }}</td>
                            <td class="centered-column">
                                <form action=" " method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $pj->id }}">
                                    <button type="submit" name="status" class="btn btn-success" value="ACC"><i
                                            class="fa-regular fa-circle-check"></i></button>
                                </form>
                                <button type="button" class="btn btn-danger delete-button" value="TOLAK"
                                        id="rejectButton_{{ $pj->id }}">
                                    <i class="fa-regular fa-circle-xmark"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach --}}
                {{-- <tr class="centered-column">
                    <td>1</td>
                    <td>A11.2021.13550</td>
                    <td>Muhammad Maulana Hikam</td>
                    <td>
                        <a href="#" class="btn btn-warning"><i class="fa-solid fa-images"></i></a>
                    </td>
                    <td>3.84</td>
                    <td>Aplikasi Identifikasi Penyakit Kanker</td>
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
        {{-- <script>
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
        </script> --}}
    @endsection