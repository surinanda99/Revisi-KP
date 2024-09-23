@extends('koor.layouts.main')
@section('title', 'Daftar Data Dosen')
@section('content')
    <div class="container-koor">
        <h4 class="mb-4">Data Dosen Pembimbing</h4>

        <div class="row mb-2">
            <div class="col-md">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogTambah"><i class="fas fa-plus"></i> Tambah Data</a>
                <button class="btn btn-success ms-1" data-bs-toggle="modal" data-bs-target="#dialogImport"><i class="fas fa-file-import"></i> Import</button>
            </div>

            <!-- Search Bar -->
            <div class="col-md d-flex justify-content-end">
                <div class="input-group" style="width: 400px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" id="searchBar" class="form-control form-control-sm" placeholder="Cari Nama Dosen" onkeyup="searchTable()">
                </div>
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

        <div class="table-container table-logbook">
            <table class="table table-bordered">
                <thead class="table-header">
                    <tr>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosens as $dosen)
                        <tr id="row-{{ $dosen->id }}" class="{{ $dosen->sisa_kuota == 0 ? 'bg-light text-muted' : '' }}">
                            <td class="centered-column">{{ $loop->iteration }}</td>
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
    
        // Function for searching in the table
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchBar");
            filter = input.value.toUpperCase();
            table = document.querySelector(".table");
            tr = table.getElementsByTagName("tr");
    
            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2]; // Kolom nama dosen
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    
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
    
@endsection
