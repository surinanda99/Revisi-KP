@extends('koor.layouts.main')
@section('title', 'Daftar Data Mahasiswa')
@section('content')
    <div class="container-koor">
        <h4 class="mb-4">Data Mahasiswa</h4>

        <p class="mb-2 d-flex align-items-center">
            <div class="col-md">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogTambah"><i class="fas fa-plus"></i>Tambah Data</a>
                <button class="btn btn-success ms-1" data-bs-toggle="modal" data-bs-target="#dialogImport"><i class="fas fa-file-import"></i>&nbsp;Import</button>
            </div>
        </p>
            
        <!-- Import Mahasiswa Modal -->
        <div class="modal fade" id="dialogImport" tabindex="-1" aria-labelledby="dialogImportLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('importMhs') }}" class="modal-content" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="dialogImportLabel">Import Data Mahasiswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <a href="{{ route('templateMahasiswa') }}" class="btn btn-info">
                                <i class="fas fa-download"></i> Download Template Excel
                            </a>
                        </div>
                        <div>
                            <label for="import" class="form-label fw-semibold">Data Excel</label>
                            <input type="file" class="form-control @error('import') is-invalid @enderror" name="import" placeholder="Masukkan data excel" value="{{ old('import') }}">
                            @error('import')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row my-4">
            <div class="col-md">
                <div class="table-responsive" id="tableContainer" style="display: none;">
                    <table class="table table-bordered table-striped table-hover align-middle" id="mahasiswaTable">
                        <thead class="table-header">
                            <th class="align-middle">No.</th>
                            <th class="align-middle">NIM</th>
                            <th class="align-middle">Nama Mahasiswa</th>
                            <th class="align-middle">Email</th>
                            <th class="align-middle">Dosen Pembimbing</th>
                            <th class="align-middle">Status KP</th>
                            <th class="align-middle">Aksi</th>
                        </thead>
                        <tbody id="tableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--Dialog detail mahasiswa-->
    @include('koor.data_mahasiswa.detail_mhs')

    <!--Dialog Edit mahasiswa-->
    @include('koor.data_mahasiswa.edit_mhs')

    <!--Dialog Tambah Mahasiswa-->
    @include('koor.data_mahasiswa.tambah_data')

    <!--Dialog Hapus Mahasiswa-->
    @include('koor.data_mahasiswa.hapus')

    <script>
        $(document).ready(function() {
            // Tampilkan animasi loading saat halaman pertama kali dibuka
            Swal.fire({
                title: 'Loading...',
                html: '<div class="loading-spinner"></div>',
                showConfirmButton: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Delay untuk menampilkan isi tabel
            setTimeout(function() {
                // Tutup animasi loading
                Swal.close();

                // Tampilkan tabel setelah delay
                $('#tableContainer').fadeIn();
            
                // Inisialisasi DataTable
                $('#mahasiswaTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "/list-data-mhs",
                        "type": "GET",
                        "dataSrc": "data" // Pastikan ini sesuai dengan format respons Anda
                    },
                    "columns": [
                        { 
                            "data": null, 
                            "render": function (data, type, row, meta) {
                                // Hitung nomor urut berdasarkan `start` dan `meta.row`
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        { "data": "nim" },
                        { "data": "nama" },
                        { "data": "email" },
                        { "data": "status_mahasiswa.dospem.nama", "defaultContent": "Belum ada dosen pembimbing" },
                        { "data": "status_kp", "defaultContent": "-" },
                        {
                            "data": null,
                            "orderable": false,
                            "render": function(data, type, row) {
                                return `
                                    <button class="btn btn-primary btn-detail" data-bs-toggle="modal" data-bs-target="#dialogDetailDataMahasiswa_${row.id}">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <button class="btn btn-warning me-1 btn-edit" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#dialogEditMhs_${row.id}">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-delete" data-id="${row.id}" data-bs-toggle="modal" data-bs-target="#dialogHapusMhs_${row.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>`;
                            }
                        }
                    ],
                    "pageLength": 10,
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "language": {
                        "search": "Cari:",
                        "lengthMenu": "Tampilkan _MENU_ entri per halaman",
                        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                        "infoFiltered": "(disaring dari _MAX_ total entri)",
                        "zeroRecords": "Tidak ada data yang cocok",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        }
                    },
                    "order": [[ 1, 'asc' ]]
                });
            }, 2000);    
        });

        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    successAlert.style.display = 'none';
                }

                var errorAlert = document.getElementById('error-alert');
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
            }, 3000);
        });
    </script>

    <style>
        /* Loading spinner style specific to SweetAlert */
        .swal2-html-container .swal-loading-spinner {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border: 8px solid rgba(0, 0, 0, 0.1);
            border-top: 8px solid #3498db; /* Biru di bagian atas */
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Keyframes for spinner animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Mengubah tampilan SweetAlert agar lebih baik dengan spinner */
        .swal2-popup {
            background-color: rgba(255, 255, 255, 0.9) !important;
        }

        .swal2-title {
            color: #3498db !important;
            font-weight: bold;
        }
    </style>

@endsection