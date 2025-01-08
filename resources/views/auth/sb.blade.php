<!-- Sidebar Structure -->
<div class="d-flex flex-column bg-dark vh-100" id="sidebarMenu">
    <ul class="navbar-nav flex-column">
        @guest
        <li></li>
        @else
        <li class="nav-item">
            <a class="nav-link text-white" href="#" role="button" data-bs-toggle="collapse" data-bs-target="#mainMenu" aria-expanded="false" aria-controls="mainMenu">
                Dashboard
            </a>
            <ul class="collapse" id="mainMenu">
                @if (auth()->user()->role === 'mahasiswa')
                <li>
                    <a class="nav-link text-white" href="{{ route('dashboard.mahasiswa') }}">Dashboard</a>
                </li>
                <li>
                    <a class="nav-link text-white" href="{{ route('rekomendasi.mahasiswa') }}">Rekomendasi Akademik</a>
                </li>
                <!-- Nested items -->
                <li>
                    <a class="nav-link text-white" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-sidang" aria-expanded="false" aria-controls="submenu-sidang">Pendaftaran Sidang</a>
                    <ul class="collapse" id="submenu-sidang">
                        @if(isset(auth()->user()->mahasiswa) && auth()->user()->mahasiswa->prodi != 'D3 Sistem Informasi')
                        <li><a class="nav-link text-white ps-4" href="{{ route('berkas-proposal.index') }}">Sidang Proposal</a></li>
                        @endif
                        <li><a class="nav-link text-white ps-4" href="{{ route('berkas-skripsi.index') }}">Sidang Skripsi</a></li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link text-white" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-jadwal" aria-expanded="false" aria-controls="submenu-jadwal">Jadwal Sidang</a>
                    <ul class="collapse" id="submenu-jadwal">
                        @if(isset(auth()->user()->mahasiswa) && auth()->user()->mahasiswa->prodi != 'D3 Sistem Informasi')
                        <li><a class="nav-link text-white ps-4" href="{{ route('jadwal-proposal.index') }}">Sidang Proposal</a></li>
                        @endif
                        <li><a class="nav-link text-white ps-4" href="{{ route('jadwal-skripsi.index') }}">Sidang Skripsi</a></li>
                    </ul>
                </li>
                <!-- Add more items as per role-based conditions -->
                @endif
            </ul>
        </li>
        <!-- Repeat similar structure for other roles like 'kaprodi', 'dosen', 'admin' -->
        @endguest
    </ul>
</div>
