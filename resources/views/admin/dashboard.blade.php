@extends('admin.layouts.main')
@section('title', 'Dashboard Admin')
@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>   
</div>

<div class="container mt-4">
    <div class="row">
        <!-- Data Mahasiswa -->
        <div class="col-md-6 mb-4">
            <div class="card border-primary shadow h-100 rounded-lg">
                <div class="card-header bg-primary text-white">
                    <h5>Data Mahasiswa</h5>
                </div>
                <div class="card-body">
                    <!-- Add link/button to navigate to Mahasiswa data page -->
                    {{-- <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-primary btn-block">Lihat Data Mahasiswa</a> --}}
                </div>
            </div>
        </div>
        
        <!-- Data Dosen -->
        <div class="col-md-6 mb-4">
            <div class="card border-success shadow h-100 rounded-lg">
                <div class="card-header bg-success text-white">
                    <h5>Data Dosen</h5>
                </div>
                <div class="card-body">
                    <!-- Add link/button to navigate to Dosen data page -->
                    {{-- <a href="{{ route('admin.dosen.index') }}" class="btn btn-success btn-block">Lihat Data Dosen</a> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Data Koor -->
        <div class="col-md-6 mb-4">
            <div class="card border-warning shadow h-100 rounded-lg">
                <div class="card-header bg-warning text-white">
                    <h5>Data Koor</h5>
                </div>
                <div class="card-body">
                    <!-- Add link/button to navigate to Koor data page -->
                    {{-- <a href="{{ route('admin.koor.index') }}" class="btn btn-warning btn-block">Lihat Data Koor</a> --}}
                </div>
            </div>
        </div>
        
        <!-- Data Admin -->
        <div class="col-md-6 mb-4">
            <div class="card border-info shadow h-100 rounded-lg">
                <div class="card-header bg-info text-white">
                    <h5>Data Admin</h5>
                </div>
                <div class="card-body">
                    <!-- Add link/button to navigate to Admin data page -->
                    {{-- <a href="{{ route('admin.admin.index') }}" class="btn btn-info btn-block">Lihat Data Admin</a> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Aktivitas Terkini -->
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-info text-white">
                    <h5 class="m-0 font-weight-bold">Aktivitas Terkini</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aktivitas</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add recent activity rows here -->
                            <tr>
                                <td>1</td>
                                <td>Mahasiswa A mengajukan proposal Kerja Praktek</td>
                                <td>2024-05-01</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mahasiswa B telah menyelesaikan Bab 2 laporan KP</td>
                                <td>2024-05-05</td>
                            </tr>
                            <!-- Add more activity rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
