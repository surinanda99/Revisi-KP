@extends('dosen.layouts.main')
@section('title', 'Dashboard Dosen')
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
                <h1 class="mt-4"><b>Welcome, {{ $dosen->nama }}</b></h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card text-dark mb-4" id="card-view">
                            <div class="card-body"><b>Mahasiswa Bimbingan</b></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-dark stretched-link" href="{{ route('pageDaftarMhsBimbingan') }}">See Details</a>
                                <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card text-dark mb-4" id="card-view">
                            <div class="card-body"><b>Logbook Mahasiswa</b></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-dark stretched-link" href="{{ route('dosbing-logbook') }}">See Details</a>
                                <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card text-dark mb-4" id="card-view">
                            <div class="card-body"><b>Mahasiswa Sidang</b></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-dark stretched-link" href="{{ route('pagePengajuanSidang') }}">See Details</a>
                                <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card text-dark mb-4" id="card-view">
                            <div class="card-body"><b>Tentang Kami</b></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-dark stretched-link" href="/about">See Details</a>
                                <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chart Mahasiswa TA 1 & TA 2 -->
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Chart Logbook Mahasiswa
                            </div>
                            <div class="card-body">
                                <div id="logbookChart" class="chart-canvas" width="100%" height="40"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Chart Mahasiswa KP
                            </div>
                            <div class="card-body">
                                <div id="chartMahasiswaTA" class="chart-canvas" width="100%" height="40"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Informasi Kuota Bimbingan -->
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-regular fa-address-book me-1"></i>
                                Informasi Kuota Bimbingan
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Total Kuota</th>
                                        <th>Jumlah Ajuan</th>
                                        <th>Jumlah Diterima</th>
                                        <th>Sisa Kuota</th>
                                    </tr>
                                    </thead>
                                    <tbody class="centered-column">
                                    <tr>
                                        <td>{{ $dosen->dosen->kuota }}</td>
                                        <td>{{ $jumlahAjuan }}</td>
                                        <td>{{ $dosen->dosen->ajuan_diterima }}</td>
                                        <td>{{ $dosen->dosen->sisa_kuota }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
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
    <script>
        function markAsRead(element) {
            element.innerHTML = 'Read';
            element.style.cursor = 'default';
        }
    </script>
</main>
@endsection




{{-- @extends('dosen.layouts.main')
@section('title', 'Dashboard Dosen')
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
                <h1 class="mt-4"><b>Welcome, {{ $dosen->nama }}</b></h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card text-dark mb-4" id="card-view">
                            <div class="card-body"><b>Mahasiswa Bimbingan</b></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="">See
                                    Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card text-dark mb-4" id="card-view">
                            <div class="card-body"><b>Logbook Mahasiswa</b></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="">See
                                    Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card text-dark mb-4" id="card-view">
                            <div class="card-body"><b>Mahasiswa Sidang</b></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link"
                                   href="">See
                                    Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card text-dark mb-4" id="card-view">
                            <div class="card-body"><b>Tentang Kami</b></div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="/about">See Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chart Mahasiswa KP 1 -->
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Mahasiswa Kerja Praktek
                            </div>
                            <div class="card-body">
                                <canvas id="chartTA1" width="100%" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                <!-- Jumlah Kuota, Ajuan, Diterima, serta Sisa Mahasiswa Bimbingan -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-regular fa-address-book me-1"></i>
                        Informasi Kuota Bimbingan
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th>Total Kuota</th>
                                <th>Jumlah Ajuan</th>
                                <th>Jumlah Diterima</th>
                                <th>Sisa Kuota</th>
                            </thead>
                            <tbody class="centered-column">
                                <tr>
                                    <!-- <td>5</td>
                                    <td>1</td>
                                    <td>0</td>
                                    <td>5</td> -->
                                    <td>{{ $dosen->dosen->kuota }}</td>
                                    <td>{{ $jumlahAjuan }}</td>
                                    <td>{{ $dosen->dosen->ajuan_diterima }}</td>
                                    <td>{{ $dosen->dosen->sisa_kuota }}</td>
                                </tr>
                            </tbody>
                        </table>
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
                        <a href="#" class="text-secondary">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Misalnya, jumlah notifikasi diambil dari server
            var notificationCount = 3; // Gantilah dengan jumlah notifikasi yang sesuai
            var notificationCountElement = document.getElementById('notificationCount');

            if (notificationCount > 0) {
                notificationCountElement.textContent = notificationCount;
                notificationCountElement.style.display = 'inline-block';
            } else {
                notificationCountElement.style.display = 'none';
            }
        });

        function markAsRead(button) {
            // Mark the notification as read
            button.parentElement.style.display = 'none';
            // Decrement the notification count
            let countElement = document.getElementById('notificationCount');
            let count = parseInt(countElement.innerText);
            countElement.innerText = count > 0 ? count - count : 0;
        }
    </script>
@endsection --}}