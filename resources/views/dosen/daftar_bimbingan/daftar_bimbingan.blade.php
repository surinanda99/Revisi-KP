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
                <th>Aksi</th>
                </thead>
                <tbody>
                @foreach ($pengajuan as $pj)
                    @if ($pj->status !== 'ACC') <!-- Filter out accepted submissions -->
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
                            <td class="centered-column">
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
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Alasan Penolakan -->
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">Alasan Penolakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="rejectForm">
                            <input type="hidden" name="id" id="rejectId">
                            <div class="mb-3">
                                <label for="reason" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var deleteButtons = document.querySelectorAll('.delete-button');
                var rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
                var rejectForm = document.getElementById('rejectForm');
    
                deleteButtons.forEach(function (button) {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        var id = this.id.split('_')[1]; // Ambil ID pengajuan dari ID tombol
                        document.getElementById('rejectId').value = id;
                        rejectModal.show();
                    });
                });
    
                rejectForm.addEventListener('submit', function (event) {
                    event.preventDefault();
                    var id = document.getElementById('rejectId').value;
                    var reason = document.getElementById('reason').value;
    
                    if (reason) {
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Alasan penolakan: " + reason,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, tolak!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch('/updatePengajuan', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({id: id, status: 'TOLAK', alasan: reason})
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.status === 'success') {
                                            Swal.fire('Success!', 'Pengajuan berhasil ditolak', 'success');
                                            // Lakukan tindakan tambahan setelah berhasil (misalnya, refresh tabel)
                                            location.reload(); // Contoh: Refresh halaman setelah berhasil
                                        } else {
                                            Swal.fire('Error!', 'Terjadi kesalahan saat menolak pengajuan.', 'error');
                                        }
                                    });
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                Swal.fire('Canceled!', 'Pengajuan gagal ditolak', 'error');
                            }
                        });
                    } else {
                        Swal.fire('Error!', 'Alasan penolakan harus diisi.', 'error');
                    }
                });
            });
    
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script>
            // Inisialisasi DataTables
            $(document).ready(function () {
                $('#table-log').DataTable();
            });
        </script>
    </div>
</div>

@endsection
