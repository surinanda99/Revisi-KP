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
                            <div class="card text-white mb-4" id="card-view">
                                <div class="card-body"><b>Mahasiswa Bimbingan</b></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('pageDaftarMhsBimbingan') }}">See Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" id="card-view">
                                <div class="card-body"><b>Logbook Mahasiswa</b></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('dosbing-logbook') }}">See Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" id="card-view">
                                <div class="card-body"><b>Mahasiswa Sidang</b></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{ route('pagePengajuanSidang') }}">See Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-white mb-4" id="card-view">
                                <div class="card-body"><b>Tentang Kami</b></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="/about">See Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Chart Mahasiswa KP -->
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
                                    <div id="chartMahasiswaKP" class="chart-canvas" width="100%" height="40"></div>
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
    </main>
    <!-- ApexCharts JS -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart Logbook Bimbingan (using ApexCharts)
            var logbookData = @json($logbooks);

            // Define the categories explicitly
            var categories = ['BAB 1', 'BAB 2', 'BAB 3', 'BAB 4', 'BAB 5'];

            // Initialize data for each BAB
            var seriesData = [{
                name: 'Jumlah Mahasiswa',
                data: categories.map((bab, index) => {
                    var babNumber = index + 1;
                    return logbookData.find(item => item.bab === babNumber)?.total || 0;
                })
            }];

            // Define individual colors for each bar
            var colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];

            var logbookOptions = {
                series: seriesData,
                chart: {
                    type: 'bar',
                    height: 300,  // Adjusted height for better visibility
                    width: '100%'  // Set width to 100% to use full container width
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '80%',  // Adjust column width for better appearance
                        endingShape: 'rounded', // Optional: for better aesthetics
                        distributed: true  // Enable distributed colors
                    }
                },
                dataLabels: {
                    enabled: false,  // Disable data labels to show values on bars
                },
                xaxis: {
                    categories: categories,
                    title: {
                        text: 'Logbook Bimbingan'
                    },
                    labels: {
                        style: {
                            colors: '#000',  // Set color of x-axis labels for readability
                            fontSize: '12px'  // Adjust font size for better visibility
                        }
                    }
                },
                yaxis: {
                    min: 0,  // Minimum value to display on y-axis
                    max: Math.max(...seriesData[0].data) + 4,  // Dynamic max value based on data
                    tickAmount: 5,  // Number of ticks on y-axis
                    title: {
                        text: 'Jumlah Mahasiswa'
                    },
                    labels: {
                        formatter: function (value) {
                            return value.toFixed(0); // Ensure no decimal places
                        }
                    }
                },
                colors: colors,  // Set the colors for the bars
                legend: {
                    position: 'bottom',  // Moved legend to the bottom for better layout
                    horizontalAlign: 'center',  // Center the legend horizontally
                    offsetY: 10  // Offset legend slightly down from the bottom
                },
                tooltip: {
                    theme: 'dark',  // Dark theme for tooltips for better contrast
                    x: {
                        show: true,
                        formatter: function (value) {
                            return categories[value] || '';
                        }
                    }
                }
            };

            var logbookChart = new ApexCharts(document.querySelector("#logbookChart"), logbookOptions);
            logbookChart.render();

            // Mahasiswa KP chart (using ApexCharts)
            var kpOptions = {
                series: [{{ $kpCount }}],
                chart: {
                    type: 'donut',
                    height: 312
                },
                labels: ['KP'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200,
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                colors: ['#36A2EB'],
            };

            var kpChart = new ApexCharts(document.querySelector("#chartMahasiswaKP"), kpOptions);
            kpChart.render();
        });
    </script>
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