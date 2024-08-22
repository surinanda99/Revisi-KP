@extends('koor.layouts.main')
@section('title', 'Pengumuman')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Kelola Pengumuman</h1>
        <button>Testing</button>

        <p>Testing</p>
        @if ($pengumuman->count() > 0)
            <p>Jumlah pengumuman: {{ $pengumuman->count() }}</p>
        @else
            <p>Tidak ada pengumuman.</p>
        @endif
        <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahPengumumanModal">Tambah Pengumuman
            Baru</button>


        <table id="tabelPengumuman" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Isi Pengumuman</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengumuman as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->judul }}</td>
                        <td>{{ $p->isi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @include('koor.pengumuman.add_pengumuman')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('test');
            $('#tabelPengumuman').DataTable();
        });
    </script>
@endsection
