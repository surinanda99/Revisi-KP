@extends('koor.layouts.main')
@section('title', 'Daftar Data Dosen')
@section('content')
<div class="container-koor">
    <h4 class="mb-4">Data Dosen Pembimbing</h4>

    <p class="mb-2 d-flex align-items-center">
        {{-- <a href="{{ route('tambahDosen') }}" class="btn btn-primary me-2">
            <i class="fas fa-plus"></i> Tambah
        </a>
        <button data-bs-toggle="modal" data-bs-target="#DosenModal" class="btn btn-md btn-success fw-bold my-auto me-1">
            <i class="lni lni-exit-down"></i> Import</button>
        </button> --}}
        <div class="col-md">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogTambah"><i
                    class="fas fa-plus"></i>Tambah Data</a>
            <a target="_blank" class="btn btn-success ms-1" data-bs-toggle="modal" data-bs-target="#dialogImport"><i
                    class="fas fa-file-import"></i>&nbsp;Import</a>
        </div>

         <!-- Import Dosen Modal -->
         <div class="modal fade" id="DosenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('importDosen') }}" class="modal-content" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data Dosen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="exampleFormControlInput1" class="form-label fw-semibold">Data Excel</label>
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
    </p>

    @if (Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::get('error'))
        <div class="alert alert-danger mt-3">
            {{ Session::get('error') }}
        </div>
    @endif
    
    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <th class="align-middle">No.</th>
                <th class="align-middle">NPP</th>
                <th class="align-middle">Nama Dosen Pembimbing</th>
                <th class="align-middle">Bidang Kajian</th>
                <th class="align-middle">Kuota Mhs KP baru</th>
                <th class="align-middle">Jumlah Ajuan</th>
                <th class="align-middle">Ajuan Diterima</th>
                <th class="align-middle">Sisa Kouta</th>
                <th class="align-middle">Status</th>
                <th class="align-middle">Aksi</th>
            </thead>
            <tbody>
                @foreach($dosens as $dosen)
                <tr>
                    <td class="centered-column">{{ $loop->iteration }}</td>
                    <td class="centered-column">{{ $dosen->npp }}</td>
                    <td class="centered-column">{{ $dosen->nama }}</td>
                    <td class="centered-column">{{ $dosen->bidang_kajian }}</td>
                    <td class="centered-column">{{ $dosen->kuota }}</td>
                    <td class="centered-column">{{ $dosen->jumlah_ajuan }}</td>
                    <td class="centered-column">{{ $dosen->ajuan_diterima }}</td>
                    <td class="centered-column">{{ $dosen->sisa_kuota }}</td>
                    <td class="centered-column">{{ $dosen->status }}</td>
                    <td class="centered-column">
                        <div class="d-inline">
                            <button type="button" class="btn btn-primary btn-detail" data-bs-toggle="modal" data-bs-target="#dialogDetailDataDosen_{{ $dosen->id }}">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button class="btn btn-warning me-1 btn-edit" data-id="{{ $dosen->id }}" data-bs-toggle="modal" data-bs-target="#dialogEditDosen_{{ $dosen->id }}">
                                <i class="far fa-edit"></i>
                            </button>
                        </div>
                        <form action="{{ route('hapusDosen', ['id' => $dosen->id]) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
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

<!--Dialog Tambah dosen-->
@include('koor.data_dosen.detail_dosen')

<!--Dialog Edit dosen-->
@include('koor.data_dosen.edit_dosen')

<!--Dialog tambah 2 dosen-->
@include('koor.data_dosen.tambah') 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-edit').click(function() {
            console.log("Tombol edit diklik"); // Untuk memeriksa apakah fungsi click ini dijalankan
            var id = $(this).data('id');
            $.ajax({
                url: '/edit-dosen/' + id,
                type: 'GET',
                success: function(response) {
                    console.log(response); // Untuk memeriksa data respons dari server
                    $('#inputKuota').val(response.kuota);
                    $('#inputJumlahAjuan').val(response.jumlah_ajuan);
                    $('#dialogEditDosen_' + id).modal('show'); // Menggunakan ID unik untuk menampilkan modal
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Menampilkan pesan kesalahan jika terjadi kesalahan pada permintaan AJAX
                }
            });
        });
    });
</script>

@endsection