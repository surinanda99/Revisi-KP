<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-list"></i>
            </button>
            <div class="sidebar-logo">
                <a href="/mahasiswa">kerja praktek</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="/mahasiswa" class="sidebar-link">
                    <i class="lni lni-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/data_dosen" class="sidebar-link">
                    <i class="lni lni-pencil-alt"></i>
                    <span>Daftar Dosen Pembimbing</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="/data_mhs" class="sidebar-link">
                    <i class="lni lni-notepad"></i>
                    <span>Daftar Mahasiswa</span>
                </a>
            </li>
            {{-- <li class="sidebar-item">
                <a href="/Review" class="sidebar-link">
                    <i class="lni lni-add-files"></i>
                    <span>Review Penyelia</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/Profil" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Profil Mahasiswa</span>
                </a>
            </li> --}}
        </ul>
        <div class="sidebar-footer">
            <a href="/tentang" class="sidebar-link">
                <i class="lni lni-code-alt"></i>
                <span>Tentang</span>
            </a>
        </div>
        <div class="sidebar-footer">
            <a href="#" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
    <div class="main p-3">
        @yield('content')
    </div>
</div>