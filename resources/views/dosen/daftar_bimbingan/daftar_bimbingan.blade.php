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
            {{-- <div class="input-group justify-content-end mb-3">
                <input class="form-control" type="text" placeholder="Search here..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div> --}}
            <div class="table-container table-dosbing">
                <table class="table table-bordered mb-1" id="table-log">
                    <thead class="table-header">
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Foto</th>
                        <th>IPK</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Status Magang</th>
                    </thead>
                    @foreach ($pengajuan as $pj)
                        <tr class="centered-column">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pj->mahasiswa->nim }}</td>
                            <td>{{ $pj->mahasiswa->nama }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="{{ $pj->mahasiswa->id }}">
                                    <i class="fa-solid fa-images"></i>
                                </button>
                            </td>
                            <td>{{ $pj->mahasiswa->ipk }}</td>
                            <td>{{ $pj->judul }}</td>
                            <td class="centered-column">
                                @if ($pj->status == 'ACC')
                                    <button class="btn btn-success" value="ACC">
                                        Status Diterima
                                    </button>
                                @elseif ($pj->status == 'TOLAK')
                                    {{-- Status Ditolak --}}
                                    <button class="btn btn-danger" value="TOLAK">
                                        Status Ditolak
                                    </button>
                                @else
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('update-mahasiswa-bimbingan') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $pj->id }}">
                                            <button type="submit" name="status" class="btn btn-success" value="ACC">
                                                <i class="fa-regular fa-circle-check"></i> ACC
                                            </button>
                                        </form>
                                            <button type="submit" name="status" class="btn btn-danger delete-button ms-2" value="TOLAK" id="rejectButton_{{ $pj->id }}">
                                                <i class="fa-regular fa-circle-xmark"></i> TOLAK
                                            </button>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($pj->mahasiswa->statusMahasiswa->status_magang == 'SELESAI')
                                    <button type="button" class="btn btn-success" disabled>
                                        <i class="fa-regular fa-circle-check"></i> Selesai
                                    </button>
                                @else
                                    <form action="{{ route('update-selesai-magang') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $pj->id_mhs }}">
                                        <button type="submit" name="status_magang" class="btn btn-success" value="SELESAI">
                                            <i class="fa-regular fa-circle-check"></i> selesai
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <footer class="py-4 mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Kerja Praktek</div>
                    <div>
                        <a href="#" class="text-secondary">Privacy Policy</a>
                        &middot;
                        <a href="#" class="text-secondary">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
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
                            <textarea class="form-control" id="reason" name="alasan" rows="3" required></textarea>
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
                            console.log({id: id, status: 'TOLAK', alasan: reason})
                            fetch('/update-pengajuan', {
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        // Inisialisasi DataTables
        $(document).ready(function () {
            $('#table-log').DataTable();
        });
    </script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl1KUsJf1w73p4Clb2l1ftPb2iY9hbGGnKHBQ+hI6VH4fRPw8K5n5pHjtAN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWi2+M2K9K8+6eR6KAOU6zY9Cw5f6zGFLVuAl1FUd8p3jZKf06M9gE6yLg"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
            integrity="sha512-dN5BUoGJ+HJo3ImzdoECQQicIC4Z9GyD6qtuibkCwK6uykIC0mI0sRCufU68o2XmZpJfRIOnjFuWwvG+DnGF6g=="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}

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
