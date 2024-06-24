@extends('koor.layouts.main')
@section('title', 'Dashboard Koor')
@section('content')

    {{--    <nav class="sb-topnav navbar navbar-expand">--}}
    {{--        <!-- Navbar Search-->--}}
    {{--        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">--}}
    {{--            <div class="input-group">--}}
    {{--                <input class="form-control" type="text" placeholder="Search here..." aria-label="Search for..."--}}
    {{--                       aria-describedby="btnNavbarSearch"/>--}}
    {{--                <button class="btn" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>--}}
    {{--            </div>--}}
    {{--        </form>--}}
    {{--        <!-- Navbar-->--}}
    {{--        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">--}}
    {{--            <li class="nav-item dropdown">--}}
    {{--                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"--}}
    {{--                   aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>--}}
    {{--                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
    {{--                    <li><a class="dropdown-item" href="#!">Settings</a></li>--}}
    {{--                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>--}}
    {{--                    <li>--}}
    {{--                        <hr class="dropdown-divider"/>--}}
    {{--                    </li>--}}
    {{--                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>--}}
    {{--                </ul>--}}
    {{--            </li>--}}
    {{--        </ul>--}}
    {{--    </nav>--}}

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><b>Dashboard</b></h1>
            {{--            <ol class="breadcrumb mb-4">--}}
            {{--                <li class="breadcrumb-item active">Dashboard</li>--}}
            {{--            </ol>--}}
            <!-- Data Mahasiswa Table -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Mahasiswa
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTableMahasiswa" width="100%"
                               cellspacing="0">
                            <thead class="table-primary">
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Dosen Wali</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach($mahasiswa as $mhs)
                                <tr>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->dosen_wali }}</td>
                                </tr>
                            @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Data Dosen Pembimbing Table -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Dosen Pembimbing
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTableDosen" width="100%"
                               cellspacing="0">
                            <thead class="table-success">
                            <tr>
                                <th>NPP</th>
                                <th>Nama</th>
                                <th>Bidang Kajian</th>
                                <th>Kuota Mhs Kerja Praktek (Baru)</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach($dosen as $ds)
                                <tr>
                                    <td>{{ $ds->npp }}</td>
                                    <td>{{ $ds->nama }}</td>
                                    <td>{{ $ds->bidang_kajian }}</td>
                                    <td>{{ $ds->kuota_mhs_ta }}</td>
                                </tr>
                            @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Data Logbook Bimbingan Table -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Logbook Bimbingan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTableLogbook" width="100%"
                               cellspacing="0">
                            <thead class="table-info">
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <th>Tanggal Bimbingan</th>
                                <th>Uraian Bimbingan</th>
                                <th>Dokumen</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach($logbookBimbingan as $logbook)
                                <tr>
                                    <td>{{ $logbook->mahasiswa->mahasiswa->nama }}</td>
                                    <td>{{ $logbook->tanggal_bimbingan }}</td>
                                    <td>{{ $logbook->uraian_bimbingan }}</td>
                                    <td><a href="{{ $logbook->dokumen }}" target="_blank">Dokumen</a></td>
                                </tr>
                            @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTableMahasiswa').DataTable();
        $('#dataTableDosen').DataTable();
        $('#dataTableLogbook').DataTable();
    });
</script> --}}
