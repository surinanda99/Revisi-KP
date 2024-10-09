@extends('koor.layouts.main')
@section('title', 'Daftar Data Dosen')
@section('content')
    <div class="container-koor">
        <h4 class="mb-4">Data Dosen Pembimbing</h4>

        <div class="row mb-3">
            <div class="col-md">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogTambah"><i class="fas fa-plus"></i> Tambah Data</a>
                <button class="btn btn-success ms-1" data-bs-toggle="modal" data-bs-target="#dialogImport"><i class="fas fa-file-import"></i> Import</button>
            </div>
        </div>

        <!-- Import Dosen Modal -->
        <div class="modal fade" id="dialogImport" tabindex="-1" aria-labelledby="dialogImportLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('importDosen') }}" class="modal-content" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="dialogImportLabel">Import Data Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <a href="{{ route('templateDosen') }}" class="btn btn-info">
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
                <div class="table-responsive" style="display: none;" id="tableContainer">
                    <table class="table table-bordered table-striped table-hover align-middle" id="dosenTable">
                        <thead class="table-header">
                            <th class="align-middle">No.</th>
                            <th class="align-middle">NPP</th>
                            <th class="align-middle">Nama Dosen Pembimbing</th>
                            <th class="align-middle">Bidang Kajian</th>
                            <th class="align-middle">Kuota Mhs KP</th>
                            <th class="align-middle">Jumlah Ajuan</th>
                            <th class="align-middle">Ajuan Diterima</th>
                            <th class="align-middle">Ajuan Ditolak</th>
                            <th class="align-middle">Sisa Kuota</th>
                            <th class="align-middle">Status</th>
                            <th class="align-middle">Aksi</th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>      
                </div>
            </div>
        </div>
    </div>

    <!-- Include all modals -->
    @include('koor.data_dosen.tambah')
    @include('koor.data_dosen.detail_dosen')
    @include('koor.data_dosen.edit')
    @include('koor.data_dosen.hapus')

    <!-- jQuery and SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

            // Initialize DataTable with AJAX
            var table = $('#dosenTable').DataTable({
                serverSide: true,
                ajax: {
                    url: '{{ route('dataDosenAjax') }}',
                    type: 'GET',
                    complete: function() {
                        // Tutup animasi loading setelah data berhasil dimuat
                        Swal.close();
                        $('#tableContainer').show(); // Tampilkan kontainer tabel
                    }
                },
                columns: [
                    { data: null, render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1; // Display the row number
                    }},
                    { data: 'npp' },
                    { data: 'nama' },
                    { data: 'bidang_kajian' },
                    { 
                        data: 'kuota', 
                        render: function(data, type, row) {
                            return '<input type="number" class="form-control kuota-edit" data-id="' + row.id + '" value="' + data + '" style="width: 80px; text-align: center; margin: 0 auto;"/>';
                        },
                        orderable: false, // Disable ordering for this column
                        searchable: false // Disable searching for this column
                    },
                    { data: 'jumlah_ajuan' },
                    { data: 'ajuan_diterima' },
                    { data: 'ajuan_ditolak' },
                    { data: 'sisa_kuota' },
                    { data: 'status', render: function(data) {
                        return data == 'Penuh' ? '<span class="badge bg-danger">' + data + '</span>' : '<span class="badge bg-success">' + data + '</span>';
                    }},
                    { data: 'id', render: function(data) {
                        return `
                            <button class="btn btn-primary btn-detail" data-bs-toggle="modal" data-bs-target="#dialogDetailDataDosen_${data}">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button class="btn btn-warning me-1 btn-edit" data-id="${data}" data-bs-toggle="modal" data-bs-target="#dialogEditDosen_${data}">
                                <i class="far fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-delete" data-id="${data}" data-bs-toggle="modal" data-bs-target="#dialogHapusDosen_${data}">
                                <i class="fas fa-trash"></i>
                            </button>
                        `;
                    }}
                ],
                createdRow: function(row, data, dataIndex) {
                    // Add the id and class based on sisa_kuota
                    $(row).attr('id', 'row-' + data.id);
                    if (data.sisa_kuota == 0) {
                        $(row).addClass('bg-light text-muted');
                    }
                },
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                }
            });

            // Inisialisasi Select2 ketika modal "Tambah Data Mahasiswa" dibuka
            $('.modal').on('shown.bs.modal', function() {
                $('.js-example-basic-single').select2({
                    dropdownParent: $(this),
                    width: '100%',
                    placeholder: 'Pilih Mahasiswa',
                    allowClear: true,
                    minimumResultsForSearch: 0, // Tampilkan semua hasil tanpa harus mengetik
                });
            });

            // Handle kuota input change
            $(document).on('change', '.kuota-edit', function() {
                var id = $(this).data('id');
                var newKuota = $(this).val();
    
                $.ajax({
                    url: "{{ route('updateKuota', '') }}/" + id, 
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        kuota: newKuota
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        // Update the remaining quota (sisa kuota)
                        $('#sisa-kuota-' + id).text(response.sisa_kuota);

                        // Update the status of the dosen (full or available)
                        if (response.sisa_kuota == 0) {
                            $('#status-dosen-' + id).html('<span class="badge bg-danger">Penuh</span>');
                            $('#row-' + id).addClass('bg-light text-muted');
                        } else {
                            $('#status-dosen-' + id).html('<span class="badge bg-success">Tersedia</span>');
                            $('#row-' + id).removeClass('bg-light text-muted');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON.error,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            });

            // Function to handle click on edit button
            $('.btn-edit').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/edit-dosen/' + id,
                    type: 'GET',
                    success: function(response) {
                        $('#editDosenId').val(response.id);
                        $('#inputNPP').val(response.npp);
                        $('#inputNama').val(response.nama);
                        $('#inputBidangKajian').val(response.bidang_kajian);
                        $('#inputKuota').val(response.kuota);
                        $('#dialogEditDosen').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Function to handle click on delete button
            $('.btn-delete').click(function() {
                var id = $(this).data('id');
                $('#dialogHapusDosen_' + id).modal('show');
            });
        });
    
        // Hide success/error alerts after 3 seconds
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