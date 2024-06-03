@extends('koor.layouts.main')
@section('title', 'Dashboard Koor')
@section('content')
<div class="container">
    <h1>Dashboard Koor</h1>   
</div>

<div class="container">
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
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mahasiswa A mengajukan proposal Kerja Praktek</td>
                                <td>2024-05-01</td>
                                <td><a href="{{ url('/aktivitas/1') }}" class="btn btn-info btn-sm">Lihat</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mahasiswa B telah menyelesaikan Bab 2 laporan KP</td>
                                <td>2024-05-05</td>
                                <td><a href="{{ url('/aktivitas/2') }}" class="btn btn-info btn-sm">Lihat</a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Mahasiswa C meminta tinjauan untuk Bab 3 laporan KP</td>
                                <td>2024-05-10</td>
                                <td><a href="{{ url('/aktivitas/3') }}" class="btn btn-info btn-sm">Lihat</a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Mahasiswa D telah menyelesaikan presentasi KP</td>
                                <td>2024-05-15</td>
                                <td><a href="{{ url('/aktivitas/4') }}" class="btn btn-info btn-sm">Lihat</a></td>
                            </tr>
                            <!-- Add more aktivitas rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
