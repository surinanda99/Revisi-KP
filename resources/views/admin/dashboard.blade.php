@extends('admin.layouts.main')
@section('title', 'Dashboard Admin')
@section('content')
<div class="container">
        <h1>Dashboard Admin</h1>   
</div>


    <div class="container mt-4">
        <div class="row">
            <!-- Detail Mahasiswa Bimbingan -->
            <div class="col-md-6 mb-4">
                <div class="card border-primary shadow h-100 rounded-lg">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h5 class="text-primary">Detail Mahasiswa Bimbingan</h5>
                        <p class="text-muted">Lihat dan kelola detail mahasiswa</p>
                    </div>
                </div>
            </div>
            
            <!-- Pengajuan KP -->
            <div class="col-md-6 mb-4">
                <div class="card border-success shadow h-100 rounded-lg">
                    <div class="card-body text-center">
                        <i class="fas fa-file-signature fa-3x text-success mb-3"></i>
                        <h5 class="text-success">Pengajuan KP</h5>
                        <p class="text-muted">Tinjau dan setujui pengajuan KP</p>
                    </div>
                </div>
            </div>
            
            <!-- Review Mahasiswa -->
            <div class="col-md-6 mb-4">
                <div class="card border-warning shadow h-100 rounded-lg">
                    <div class="card-body text-center">
                        <i class="fas fa-book-reader fa-3x text-warning mb-3"></i>
                        <h5 class="text-warning">Review Mahasiswa</h5>
                        <p class="text-muted">Lakukan review progres mahasiswa</p>
                    </div>
                </div>
            </div>
            
            <!-- Logbook Mahasiswa -->
            <div class="col-md-6 mb-4">
                <div class="card border-info shadow h-100 rounded-lg">
                    <div class="card-body text-center">
                        <i class="fas fa-book fa-3x text-info mb-3"></i>
                        <h5 class="text-info">Logbook Mahasiswa</h5>
                        <p class="text-muted">Periksa dan pantau logbook KP</p>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
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
                                <tr>
                                    <td>3</td>
                                    <td>Mahasiswa C meminta tinjauan untuk Bab 3 laporan KP</td>
                                    <td>2024-05-10</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Mahasiswa D telah menyelesaikan presentasi KP</td>
                                    <td>2024-05-15</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
