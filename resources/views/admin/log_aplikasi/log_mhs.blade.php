@extends('admin.layouts.main')
@section('title', 'Log Mahasiswa')
@section('content')

    <div class="wrapper d-flex flex-column min-vh-100">
        <div class="container flex-grow-1">
            <h4 class="mb-4">Log Mahasiswa</h4>
            <p class="mb-5">Berikut log aktivitas Mahasiswa</p>
            <div class="table-container table-admin">
                <table class="table table-bordered mb-1" id="table-log">
                    <thead class="table-header">
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Nama Mahasiswa</th>
                        <th>Aktivitas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="centered-column">1</td>
                        <td class="centered-column">dd-MM-yyyy HH:mm</td>
                        <td>MUHAMMAD MAULANA HIKAM</td>
                        <td class="centered-column">Sedang melakukan bimbingan</td>
                    </tr>
                    <tr>
                        <td class="centered-column">2</td>
                        <td class="centered-column">dd-MM-yyyy HH:mm</td>
                        <td>CLARA EDREA EVELYNA SONY PUTRI</td>
                        <td class="centered-column">Sedang melakukan bimbingan</td>
                    </tr>
                    <tr>
                        <td class="centered-column">3</td>
                        <td class="centered-column">dd-MM-yyyy HH:mm</td>
                        <td>MUHAMMAD RIZAL PRATAMA</td>
                        <td class="centered-column">Sedang melakukan bimbingan</td>
                    </tr>
                    <tr>
                        <td class="centered-column">4</td>
                        <td class="centered-column">dd-MM-yyyy HH:mm</td>
                        <td>MUH BAGUS SAPUTRO</td>
                        <td class="centered-column">Sedang melakukan bimbingan</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <footer class="py-4 mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Bimbingan Online</div>
                    <div>
                        <a href="#" class="text-secondary">Privacy Policy</a>
                        &middot;
                        <a href="#" class="text-secondary">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
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
@endsection