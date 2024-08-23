@extends('koor.layouts.main')
@section('title', 'Pengumuman')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Kelola Pengumuman</h1>

        @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahPengumumanModal">Tambah Pengumuman Baru</button>

        <div class="table-responsive">
            <table id="tabelPengumuman" class="table table-bordered table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 20%">Judul</th>
                        <th style="width: 60%">Isi Pengumuman</th>
                        <th style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengumuman as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->judul }}</td>
                            <td>{{ $p->isi }}</td>
                            <td style="text-align: center">
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editPengumumanModal{{ $p->id }}">Edit</button>

                                <form action="{{ route('koor-pengumuman.destroy', $p->id) }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .table td {
            word-wrap: break-word;
            white-space: normal;
            max-width: 100%;
        }

        .table {
            table-layout: fixed; 
            width: 100%;
        }

        .table th, .table td {
            padding: 12px;
            vertical-align: middle;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menghilangkan alert secara otomatis setelah 5 detik
            setTimeout(function() {
                $('#success-alert').alert('close');
            }, 3000);
            
            $('#tabelPengumuman').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari total _MAX_ data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                }
            });
        });
    </script>

    <!-- Include Modal Tambah Pengajuan -->
    @include('koor.pengumuman.crud_pengumuman');
@endsection