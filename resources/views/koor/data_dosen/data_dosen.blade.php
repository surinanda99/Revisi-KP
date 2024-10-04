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

        <!-- Search and Length Selection -->
        <div class="row mb-3 mt-4 align-items-end">
            <div class="col-md-4">
                <form action="{{ route('HalamanKoorDosen') }}" method="GET" class="d-flex align-items-center">
                    <span class="me-2 semi-bold fs-5">Tampilkan</span>
                    <select name="length" class="form-select me-2" style="width: 80px;" onchange="this.form.submit()">
                        <option value="10" {{ request()->get('length') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request()->get('length') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request()->get('length') == 50 ? 'selected' : '' }}>50</option>
                        {{-- <option value="-1" {{ request()->get('length') == -1 ? 'selected' : '' }}>All</option> --}}
                    </select>
                    <span class="semi-bold fs-5">entries</span>
                </form>
            </div>
            <div class="col-md-8 ms-auto d-flex justify-content-end position-relative">
                <form action="{{ route('HalamanKoorDosen') }}" method="GET" class="d-flex position-relative">
                    <div style="position: relative; width: 200px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari Dosen..." 
                               value="{{ request()->get('search') }}" id="searchInput" style="padding-right: 30px;">
                        <i class="fas fa-times" id="clearIcon" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none;"></i>
                    </div>
                    <button class="btn btn-outline-secondary ms-2" type="submit">Cari</button>
                </form>
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
                <div class="table-responsive">
                    <table id="table-dosen" class="table table-bordered table-striped table-hover align-middle" id="dosenTable">
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
                            @foreach($dosens as $index => $dosen)
                                <tr class="dosen-row" id="row-{{ $dosen->id }}" class="{{ $dosen->sisa_kuota == 0 ? 'bg-light text-muted' : '' }}">
                                    <td class="centered-column">{{ $index + $dosens->firstItem() }}</td>
                                    <td class="centered-column">{{ $dosen->dosen->npp }}</td>
                                    <td class="centered-column">{{ $dosen->dosen->nama }}</td>
                                    <td class="centered-column">{{ $dosen->dosen->bidang_kajian }}</td>
                                    <td class="centered-column">
                                        <input type="number" class="form-control kuota-edit" data-id="{{ $dosen->id }}" value="{{ $dosen->kuota }}" style="width: 80px; text-align: center; margin: 0 auto;"/>
                                    </td>
                                    <td class="centered-column">{{ $dosen->jumlah_ajuan }}</td>
                                    <td class="centered-column">{{ $dosen->ajuan_diterima }}</td>
                                    <td class="centered-column">{{ $dosen->ajuan_ditolak }}</td>
                                    <td class="centered-column" id="sisa-kuota-{{ $dosen->id }}">{{ $dosen->sisa_kuota }}</td>
                                    <td class="centered-column" id="status-dosen-{{ $dosen->id }}">
                                        @if($dosen->sisa_kuota == 0)
                                            <span class="badge bg-danger">Penuh</span>
                                        @else
                                            <span class="badge bg-success">Tersedia</span>
                                        @endif
                                    </td>
                                    <td class="centered-column">
                                        <div class="d-inline">
                                            <button class="btn btn-primary btn-detail" data-bs-toggle="modal" data-bs-target="#dialogDetailDataDosen_{{ $dosen->id }}">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                            <button class="btn btn-warning me-1 btn-edit" data-id="{{ $dosen->id }}" data-bs-toggle="modal" data-bs-target="#dialogEditDosen_{{ $dosen->id }}">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-delete" data-id="{{ $dosen->id }}" data-bs-toggle="modal" data-bs-target="#dialogHapusDosen_{{ $dosen->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>      
                    {{ $dosens->links() }}
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
        const searchInput = document.getElementById('searchInput');
        const clearIcon = document.getElementById('clearIcon');
        const searchResults = document.getElementById('searchResults');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value;

            // Tampilkan ikon "x" saat pengguna mengetik
            clearIcon.style.display = query ? 'block' : 'none';
            
            // Jika query tidak kosong, lakukan AJAX request
            if (query) {
                fetch(`/search-dosen?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        // Tampilkan hasil pencarian
                        searchResults.innerHTML = '';
                        data.forEach(dosen => {
                            const resultItem = document.createElement('div');
                            resultItem.textContent = dosen.name; // Ganti dengan field yang sesuai
                            resultItem.style.padding = '8px';
                            resultItem.style.cursor = 'pointer';
                            resultItem.addEventListener('click', () => {
                                searchInput.value = dosen.name; // Isi input dengan nama yang dipilih
                                searchResults.style.display = 'none'; // Sembunyikan hasil pencarian
                            });
                            searchResults.appendChild(resultItem);
                        });
                        searchResults.style.display = data.length ? 'block' : 'none'; // Tampilkan hasil jika ada
                    });
            } else {
                searchResults.style.display = 'none'; // Sembunyikan hasil jika input kosong
            }
        });

        clearIcon.addEventListener('click', function() {
            searchInput.value = ''; // Kosongkan input
            clearIcon.style.display = 'none'; // Sembunyikan ikon
            searchResults.style.display = 'none'; // Sembunyikan hasil pencarian
        });
        
        $(document).ready(function() {
            // DataTable 1
            // $('#dosenTable').DataTable({
            //     "paging": true, 
            //     "info": false,
            //     "pageLength": 10,
            //     "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            //     "language": {
            //         "search": "Cari:",
            //         "lengthMenu": "Tampilkan _MENU_ entri",
            //         "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            //         "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            //         "infoFiltered": "(disaring dari _MAX_ total entri)",
            //         "zeroRecords": "Tidak ada data yang cocok",
            //         "paginate": {
            //             "first": "Pertama",
            //             "last": "Terakhir",
            //             "next": "Selanjutnya",
            //             "previous": "Sebelumnya"
            //         }
            //     }
            // });

            // $('#dosenTable').DataTable({
            //     "paging": true, // Pagination tetap aktif
            //     "pagingType": "simple_numbers", // Menggunakan simple numbers pagination
            //     "info": false, // Hilangkan info seperti "Menampilkan X sampai X dari Y entri"
            //     "pageLength": 10, // Default tampilkan 10 entri
            //     "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], // Length menu untuk memilih jumlah entri
            //     "language": {
            //         "search": "Cari:",
            //         "lengthMenu": "Tampilkan _MENU_ entri", // Hanya lengthMenu yang ditampilkan
            //         "zeroRecords": "Tidak ada data yang cocok"
            //     },
            //     "bLengthChange": true, // Tetap tampilkan dropdown untuk memilih jumlah data per halaman
            //     "bPaginate": true, // Pagination tetap aktif
            //     "fnDrawCallback": function() {
            //         var api = this.api();
            //         var pages = api.page.info().pages;
            //         if (pages <= 1) {
            //             $('.dataTables_paginate').hide(); // Sembunyikan pagination jika hanya ada 1 halaman
            //         }
            //     }
            // });


            // $('#dosenTable').DataTable({
            //     "processing": true,
            //     "serverSide": true,
            //     "ajax": {
            //         "url": "{{ route('HalamanKoorDosen') }}",
            //         "type": "GET",
            //         "data": function (d) {
            //             // Sertakan parameter pencarian jika ada
            //             d.search.value = $('input[type="search"]').val();
            //         }
            //     },
            //     "columns": [
            //         { "data": "id", "render": function(data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; } },
            //         { "data": "dosen.npp" },
            //         { "data": "dosen.nama" },
            //         { "data": "dosen.bidang_kajian" },
            //         { "data": "kuota" },
            //         { "data": "ajuan_diterima" },
            //         { "data": "ajuan_ditolak" },
            //         { "data": "sisa_kuota" },
            //         { "data": "sisa_kuota", "render": function(data) {
            //             return data == 0 ? '<span class="badge bg-danger">Penuh</span>' : '<span class="badge bg-success">Tersedia</span>';
            //         }},
            //         { "data": "id", "render": function(data) {
            //             return `<button class="btn btn-primary btn-detail" data-bs-toggle="modal" data-bs-target="#dialogDetailDataDosen_${data}"><i class="fas fa-info-circle"></i></button>
            //                     <button class="btn btn-warning me-1 btn-edit" data-id="${data}" data-bs-toggle="modal" data-bs-target="#dialogEditDosen_${data}"><i class="far fa-edit"></i></button>
            //                     <button class="btn btn-danger btn-delete" data-id="${data}" data-bs-toggle="modal" data-bs-target="#dialogHapusDosen_${data}"><i class="fas fa-trash"></i></button>`;
            //         }}
            //     ],
            //     "pagingType": "simple_numbers",
            //     "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            //     "language": {
            //         "search": "Cari:",
            //         "lengthMenu": "Tampilkan _MENU_ entri",
            //         "zeroRecords": "Tidak ada data yang cocok"
            //     }
            // });



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
            $('.kuota-edit').on('change', function() {
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
                    url: "{{ route('editDosen', '') }}" + id,
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

    <script>
        $(document).ready(function() {
            // DataTable
            $('#dosenTable').DataTable();

        });
    </script>
@endsection


