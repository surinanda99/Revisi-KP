@extends('koor.layouts.main')
@section('title', 'Dashboard Koor')
@section('content')
    <main>
        <div class="wrapper d-flex flex-column min-vh-100">
            <nav class="sb-topnav navbar navbar-expand">
                <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search here..." aria-label="Search for..."
                            aria-describedby="btnNavbarSearch" />
                        <button class="btn" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <!-- Notification -->
                <div class="navbar-nav px-1">
                    <div class="nav-item dropdown">
                        <a class="nav-link" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span id="notificationCount" class="badge bg-danger">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="notificationDropdown">
                            <li class="dropdown-header d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold">Notifications</span>
                                <div class="markAsRead" id="markAsRead" onclick="markAsRead(this)">Sudah dibaca</div>
                            </li>
                            <li class="dropdown-item d-flex justify-content-between align-items-center">
                                <span>New logbook entry from John Doe</span>
                            </li>
                            <li class="dropdown-item d-flex justify-content-between align-items-center">
                                <span>Jane Smith submitted her final report</span>
                            </li>
                            <li class="dropdown-item d-flex justify-content-between align-items-center">
                                <span>Meeting reminder with your students</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Navbar Profile-->
                <div class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <div class="nav-item">
                        <a class="nav-link" id="navbarDropdown" href="/profile" role="button" aria-expanded="false">
                            <img src="https://via.placeholder.com/200x200" alt="Profile Picture" class="rounded-circle" width="30" height="30">
                        </a>
                    </div>
                </div>
            </nav>
            <main>
                <div class="container-fluid px-4">
                    
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" id="card-view">
                                <div class="card-body"><b>Data Dosen</b></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('HalamanKoorDosen') }}">See Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" id="card-view">
                                <div class="card-body"><b>Data Mahasiswa</b></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('halamanKoorMhs') }}">See Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" id="card-view">
                                <div class="card-body"><b>Review Penyelia</b></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('penyeliaMhs') }}">See Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Log Aktivitas -->
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fa-regular fa-calendar-check"></i>
                                    Log Aktivitas
                                </div>
                                <div class="card-body" style="max-height: 137px; overflow-y: auto;">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Aktivitas</th>
                                        </tr>
                                        </thead>
                                        <tbody class="centered-column">
                                        @foreach($activities as $act)
                                            <tr>
                                                <td>{{ $act->created_at->format('d/m/Y') }}</td>
                                                <td>{{ $act->description }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Bimbingan Online</div>
                        <div>
                            <a href="#" class="text-secondary">Privacy Policy</a>
                            &middot;
                            <a href="#" class="text-secondary">Terms & Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
@endsection