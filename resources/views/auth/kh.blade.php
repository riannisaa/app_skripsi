<nav class="navbar sticky-top navbar-expand-lg custom-orange-navbar">
        <div class="container">
            <a class="navbar-brand" style="color: white;">Sistem Informasi Tugas Akhir</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">

                <ul class="navbar-nav">
                    @guest
                    <li>

                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: white;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu Utama
                        </a>
                        <ul class="dropdown-menu">
                            @if (auth()->user()->role === 'mahasiswa')
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard.mahasiswa') }}">Menu Utama</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('rekomendasi.mahasiswa') }}">Rekomendasi Akademik</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('topik.mahasiswa') }}">Pengajuan Topik</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('dospem.mahasiswa') }}">Pengajuan Dosen Pembimbing</a>
                            </li>
                            <li> <a class="dropdown-item" href="#"> Pendaftaran Sidang </a>
                                <ul class="submenu dropdown-menu">
                                    @if(isset(auth()->user()->mahasiswa) && auth()->user()->mahasiswa->prodi != 'D3 Sistem Informasi')
                                    <li><a class="dropdown-item" href="{{ route('berkas-proposal.index') }}">Sidang Proposal</a></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('berkas-skripsi.index') }}">Sidang Skripsi</a></li>
                                </ul>
                            </li>

                            <li> <a class="dropdown-item"> Jadwal Sidang </a>
                                <ul class="submenu dropdown-menu">
                                    @if(isset(auth()->user()->mahasiswa) && auth()->user()->mahasiswa->prodi != 'D3 Sistem Informasi')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-proposal.index')}}">Sidang Proposal</a>
                                    </li>
                                    @endif

                                    <li><a class="dropdown-item" href="{{ route('jadwal-skripsi.index')}}">Sidang Skripsi</a></li>
                                </ul>
                            </li>
                            <li> <a class="dropdown-item"> Hasil Sidang </a>
                                <ul class="submenu dropdown-menu">
                                    @if(isset(auth()->user()->mahasiswa) && auth()->user()->mahasiswa->prodi != 'D3 Sistem Informasi')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-proposal.index') }}">Sidang Proposal</a>
                                    </li>
                                    @endif

                                    <li><a class="dropdown-item" href="{{ route('hasil-skripsi.index') }}">Sidang Skripsi</a></li>
                                </ul>
                            </li>
                    </li>
                    @elseif (auth()->user()->role === 'kaprodi')
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard.kaprodi') }}">Menu Utama</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('rekomendasi.admin') }}">Rekomendasi Akademik</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('topik.kaprodi') }}">Pengajuan Topik</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('listTopik.admin') }}">Daftar Topik</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('dospem.kaprodi') }}">Pengajuan Dosen Pembimbing</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('listDosen.kaprodi') }}">Daftar Dosen Pembimbing</a>
                    </li>
                    <li> <a class="dropdown-item"> Jadwal Sidang </a>
                        <ul class="submenu dropdown-menu">
                            <li>
                                <a class="dropdown-item">Sidang Proposal</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-proposal.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">Sidang Skripsi</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">D3 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-skripsi.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li> <a class="dropdown-item"> Hasil Sidang </a>
                        <ul class="submenu dropdown-menu">
                            <li>
                                <a class="dropdown-item">Sidang Proposal</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-proposal.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">Sidang Skripsi</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">D3 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-skripsi.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @elseif (auth()->user()->role === 'dosen')
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard.dosen') }}">Menu Utama</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('rekomendasi.dosen') }}">Rekomendasi Akademik</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('dospem.dosen') }}">Daftar Mahasiswa Bimbingan</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('ketersediaan.index') }}">Ketersediaan Jadwal</a>
                    </li>
                    <li> <a class="dropdown-item"> Jadwal Sidang </a>
                        <ul class="submenu dropdown-menu">
                            <li>
                                <a class="dropdown-item">Sidang Proposal</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-proposal.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">Sidang Skripsi</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">D3 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-skripsi.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li> <a class="dropdown-item"> Hasil Sidang </a>
                        <ul class="submenu dropdown-menu">
                            <li>
                                <a class="dropdown-item">Sidang Proposal</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-proposal.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">Sidang Skripsi</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">D3 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-skripsi.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @elseif (auth()->user()->role === 'admin')
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard.admin') }}">Menu Utama</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('rekomendasi.admin') }}">Rekomendasi Akademik</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('topik.admin') }}">Pengajuan Topik</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('listTopik.admin') }}">Daftar Topik</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('dospem.admin') }}">Pengajuan Dosen Pembimbing</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('listDosen') }}">Daftar Dosen Pembimbing</a>
                    </li>
                    <li> <a class="dropdown-item"> Pendaftaran Sidang </a>
                        <ul class="submenu dropdown-menu">
                            <li>
                                <a class="dropdown-item">Sidang Proposal</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('berkas-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('berkas-proposal.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">Sidang Skripsi</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('berkas-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">D3 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('berkas-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('berkas-skripsi.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li> <a class="dropdown-item"> Jadwal Sidang </a>
                        <ul class="submenu dropdown-menu">
                            <li>
                                <a class="dropdown-item">Sidang Proposal</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-proposal.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">Sidang Skripsi</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">D3 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('jadwal-skripsi.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('showForm') }}">Kelola Formulir</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('showMahasiswa') }}">Kelola Data Mahasiswa</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('ruangan.index') }}">Kelola Ruang Sidang</a>
                    </li>
                    <li> <a class="dropdown-item" href="#"> Kelola Jadwal Sidang </a>
                        <ul class="submenu dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('plot-jadwal.index', ['prodi'=>'D3 Sistem Informasi']) }}">D3 Sistem Informasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('plot-jadwal.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('plot-jadwal.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a></li>
                        </ul>
                    </li>
                    <li> <a class="dropdown-item"> Hasil Sidang </a>
                        <ul class="submenu dropdown-menu">
                            <li>
                                <a class="dropdown-item">Sidang Proposal</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-proposal.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#">Sidang Skripsi</a>
                                <ul class="submenu dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">D3 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">S1 Sistem Informasi</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('hasil-skripsi.index', ['prodi'=>'S1 Informatika']) }}">S1 Informatika</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @elseif (auth()->user()->role === 'dekanat')
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard.admin') }}">Menu Utama</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('rekomendasi.admin') }}">Rekomendasi Akademik</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('topik.dekanat') }}">Pengajuan Topik</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('listTopik.admin') }}">Daftar Topik</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('dospem.dekanat') }}">Pengajuan Dosen Pembimbing</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('listDosen') }}">Daftar Dosen Pembimbing</a>
                    </li>
                    @endif

                </ul>
                </li>
                @endguest
                </ul>
                <ul class="navbar-nav ms-auto">
                    @guest
                    <li class="nav-item">
                        {{-- <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">Login</a> --}}
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">Register</a> --}}
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            @if (auth()->user()->role === 'mahasiswa')
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.mahasiswa') }}">Profil Saya</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                            @elseif (auth()->user()->role === 'dosen')
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.dosen') }}">Profil Saya</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                            @elseif (auth()->user()->role === 'kaprodi' || auth()->user()->role === 'admin' || auth()->user()->role === 'dekanat')
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.admin') }}">Profil Saya</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logoutAdmin') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logoutAdmin') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                            @endif

                            {{-- <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            >Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                    </li> --}}
                </ul>
                </li>
                @endguest
                </ul>


            </div>
        </div>
    </nav>