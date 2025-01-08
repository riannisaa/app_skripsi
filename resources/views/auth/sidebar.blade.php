<!-- Sidebar Structure -->
<div class="d-flex flex-column bg-light border vh-100" id="sidebarMenu">
    <ul class="navbar-nav flex-column px-3 py-3 gap-3" style="height: 80vh; overflow-y: auto">
        @if (auth()->user()->role === 'mahasiswa')
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('dashboard.mahasiswa') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z" />
                </svg>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('rekomendasi.mahasiswa') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M18 21H8V8l7-7l1.25 1.25q.175.175.288.475t.112.575v.35L15.55 8H21q.8 0 1.4.6T23 10v2q0 .175-.037.375t-.113.375l-3 7.05q-.225.5-.75.85T18 21M6 8v13H2V8z" />
                </svg>
                Rekomendasi Akademik
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('topik.mahasiswa') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M2 22V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v12q0 .825-.587 1.413T20 18H6zm4-8h8v-2H6zm0-3h12V9H6zm0-3h12V6H6z" />
                </svg>
                Pengajuan Topik
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('dospem.mahasiswa') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                    <path fill="currentColor" d="m7.603 13.267l-.215.707C4.619 13.729 3 11.84 3 10v-.5A1.5 1.5 0 0 1 4.5 8h4.54a4.27 4.27 0 0 0-1.818 3.5c0 .63.136 1.228.381 1.767M8 1.5A2.75 2.75 0 1 1 8 7a2.75 2.75 0 0 1 0-5.5m7 10a3.5 3.5 0 0 1-5.197 3.062l-1.392.423a.318.318 0 0 1-.397-.397l.424-1.391A3.5 3.5 0 1 1 15 11.5M10.5 10a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm-.5 2.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0-.5.5" />
                </svg>
                Pengajuan Dosen Pembimbing
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-sidang" aria-expanded="false" aria-controls="submenu-sidang">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 9v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8m6 6v-.172a2 2 0 0 0-.586-1.414l-3.828-3.828A2 2 0 0 0 14.172 3H14m6 6h-4a2 2 0 0 1-2-2V3" />
                </svg>
                Pendaftaran Sidang
            </a>
            <ul class="collapse" id="submenu-sidang">
                @if(isset(auth()->user()->mahasiswa) && auth()->user()->mahasiswa->prodi != 'D3 Sistem Informasi')
                <li><a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('berkas-proposal.index') }}">Sidang Proposal</a></li>
                @endif
                <li><a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('berkas-skripsi.index') }}">Sidang Skripsi</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-jadwal" aria-expanded="false" aria-controls="submenu-jadwal">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <g fill="none">
                        <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                        <path fill="currentColor" d="M16 3a1 1 0 0 1 .993.883L17 4v1h2a2 2 0 0 1 1.995 1.85L21 7v12a2 2 0 0 1-1.85 1.995L19 21H5a2 2 0 0 1-1.995-1.85L3 19V7a2 2 0 0 1 1.85-1.995L5 5h2V4a1 1 0 0 1 1.993-.117L9 4v1h6V4a1 1 0 0 1 1-1m3 9H5v7h14zm0-5H5v3h14z" />
                    </g>
                </svg>
                Jadwal Sidang
            </a>
            <ul class="collapse" id="submenu-jadwal">
                @if(isset(auth()->user()->mahasiswa) && auth()->user()->mahasiswa->prodi != 'D3 Sistem Informasi')
                <li><a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-proposal.index') }}">Sidang Proposal</a></li>
                @endif
                <li><a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-skripsi.index') }}">Sidang Skripsi</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-hasil" aria-expanded="false" aria-controls="submenu-jadwal">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m18.988 2.012l3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287l-3-3L8 13z" />
                    <path fill="currentColor" d="M19 19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2z" />
                </svg>
                Hasil Sidang
            </a>
            <ul class="collapse" id="submenu-hasil">
                @if(isset(auth()->user()->mahasiswa) && auth()->user()->mahasiswa->prodi != 'D3 Sistem Informasi')
                <li><a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-proposal.index') }}">Sidang Proposal</a></li>
                @endif
                <li><a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-skripsi.index') }}">Sidang Skripsi</a></li>
            </ul>
        </li>
        @elseif(auth()->user()->role == 'kaprodi')
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('dashboard.kaprodi') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z" />
                </svg>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('rekomendasi.admin') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M18 21H8V8l7-7l1.25 1.25q.175.175.288.475t.112.575v.35L15.55 8H21q.8 0 1.4.6T23 10v2q0 .175-.037.375t-.113.375l-3 7.05q-.225.5-.75.85T18 21M6 8v13H2V8z" />
                </svg>
                Rekomendasi Akademik
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('topik.kaprodi') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M2 22V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v12q0 .825-.587 1.413T20 18H6zm4-8h8v-2H6zm0-3h12V9H6zm0-3h12V6H6z" />
                </svg>
                Pengajuan Topik
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('listTopik.admin') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M20 9v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8m6 6v-.172a2 2 0 0 0-.586-1.414l-3.828-3.828A2 2 0 0 0 14.172 3H14m6 6h-4a2 2 0 0 1-2-2V3" />
                </svg>
                Daftar Topik
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('dospem.kaprodi') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M2 22V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v12q0 .825-.587 1.413T20 18H6zm4-8h8v-2H6zm0-3h12V9H6zm0-3h12V6H6z" />
                </svg>
                Pengajuan Dosen Pembimbing
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('listDosen.kaprodi') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M2 22V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v12q0 .825-.587 1.413T20 18H6zm4-8h8v-2H6zm0-3h12V9H6zm0-3h12V6H6z" />
                </svg>
                Daftar Dosen Pembimbing
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-sidang" aria-expanded="false" aria-controls="submenu-sidang">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M20 9v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8m6 6v-.172a2 2 0 0 0-.586-1.414l-3.828-3.828A2 2 0 0 0 14.172 3H14m6 6h-4a2 2 0 0 1-2-2V3" />
                </svg>
                Jadwal Sidang
            </a>
            <ul class="collapse" id="submenu-sidang">
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-proposal" aria-expanded="false" aria-controls="submenu-proposal">
                        Sidang Proposal
                    </a>
                    <ul class="collapse" id="submenu-proposal">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-proposal.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-skripsi" aria-expanded="false" aria-controls="submenu-skripsi">
                        Sidang Skripsi
                    </a>
                    <ul class="collapse" id="submenu-skripsi">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">
                                D3 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-skripsi.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-hasil-sidang" aria-expanded="false" aria-controls="submenu-hasil-sidang">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm-7 16H6v-2h6v2zm0-4H6v-2h6v2zm0-4H6V9h6v2zm0-4H6V5h6v2zm6 8h-4v-2h4v2zm0-4h-4V9h4v2zm0-4h-4V5h4v2z" />
                </svg>
                Hasil Sidang
            </a>
            <ul class="collapse" id="submenu-hasil-sidang">
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-hasil-proposal" aria-expanded="false" aria-controls="submenu-hasil-proposal">
                        Sidang Proposal
                    </a>
                    <ul class="collapse" id="submenu-hasil-proposal">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-proposal.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-hasil-skripsi" aria-expanded="false" aria-controls="submenu-hasil-skripsi">
                        Sidang Skripsi
                    </a>
                    <ul class="collapse" id="submenu-hasil-skripsi">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">
                                D3 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-skripsi.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        @elseif(auth()->user()->role == 'dosen')
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('dashboard.dosen') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z" />
                </svg>
                Menu Utama
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('rekomendasi.dosen') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M18 21H8V8l7-7l1.25 1.25q.175.175.288.475t.112.575v.35L15.55 8H21q.8 0 1.4.6T23 10v2q0 .175-.037.375t-.113.375l-3 7.05q-.225.5-.75.85T18 21M6 8v13H2V8z" />
                </svg>
                Rekomendasi Akademik
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('dospem.dosen') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M20 9v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8m6 6v-.172a2 2 0 0 0-.586-1.414l-3.828-3.828A2 2 0 0 0 14.172 3H14m6 6h-4a2 2 0 0 1-2-2V3" />
                </svg>
                Daftar Mahasiswa Bimbingan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('ketersediaan.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19 3h-1V2a1 1 0 1 0-2 0v1H8V2a1 1 0 1 0-2 0v1H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm0 16H5V10h14z" />
                </svg>
                Ketersediaan Jadwal
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-sidang" aria-expanded="false" aria-controls="submenu-sidang">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M20 9v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8m6 6v-.172a2 2 0 0 0-.586-1.414l-3.828-3.828A2 2 0 0 0 14.172 3H14m6 6h-4a2 2 0 0 1-2-2V3" />
                </svg>
                Jadwal Sidang
            </a>
            <ul class="collapse" id="submenu-sidang">
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-proposal" aria-expanded="false" aria-controls="submenu-proposal">
                        Sidang Proposal
                    </a>
                    <ul class="collapse" id="submenu-proposal">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-proposal.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-skripsi" aria-expanded="false" aria-controls="submenu-skripsi">
                        Sidang Skripsi
                    </a>
                    <ul class="collapse" id="submenu-skripsi">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">
                                D3 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-skripsi.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-hasil-sidang" aria-expanded="false" aria-controls="submenu-hasil-sidang">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm-7 16H6v-2h6v2zm0-4H6v-2h6v2zm0-4H6V9h6v2zm0-4H6V5h6v2zm6 8h-4v-2h4v2zm0-4h-4V9h4v2zm0-4h-4V5h4v2z" />
                </svg>
                Hasil Sidang
            </a>
            <ul class="collapse" id="submenu-hasil-sidang">
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-hasil-proposal" aria-expanded="false" aria-controls="submenu-hasil-proposal">
                        Sidang Proposal
                    </a>
                    <ul class="collapse" id="submenu-hasil-proposal">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-proposal.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-hasil-skripsi" aria-expanded="false" aria-controls="submenu-hasil-skripsi">
                        Sidang Skripsi
                    </a>
                    <ul class="collapse" id="submenu-hasil-skripsi">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">
                                D3 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-skripsi.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        @elseif(auth()->user()->role == 'admin')
        <li>
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('dashboard.admin') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z" />
                </svg>
                Menu Utama
            </a>
        </li>
        <li>
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('rekomendasi.admin') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M18 21H8V8l7-7l1.25 1.25q.175.175.288.475t.112.575v.35L15.55 8H21q.8 0 1.4.6T23 10v2q0 .175-.037.375t-.113.375l-3 7.05q-.225.5-.75.85T18 21M6 8v13H2V8z" />
                </svg>
                Rekomendasi Akademik
            </a>
        </li>
        <li>
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('topik.admin') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M2 22V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v12q0 .825-.587 1.413T20 18H6zm4-8h8v-2H6zm0-3h12V9H6zm0-3h12V6H6z" />
                </svg>
                Pengajuan Topik
            </a>
        </li>
        <li>
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('listTopik.admin') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M20 9v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8m6 6v-.172a2 2 0 0 0-.586-1.414l-3.828-3.828A2 2 0 0 0 14.172 3H14m6 6h-4a2 2 0 0 1-2-2V3" />
                </svg>
                Daftar Topik
            </a>
        </li>
        <li>
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('dospem.admin') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M2 22V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v12q0 .825-.587 1.413T20 18H6zm4-8h8v-2H6zm0-3h12V9H6zm0-3h12V6H6z" />
                </svg>
                Pengajuan Dosen Pembimbing
            </a>
        </li>
        <li>
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('listDosen') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M20 9v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8m6 6v-.172a2 2 0 0 0-.586-1.414l-3.828-3.828A2 2 0 0 0 14.172 3H14m6 6h-4a2 2 0 0 1-2-2V3" />
                </svg>
                Daftar Dosen Pembimbing
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-pendaftaran-sidang" aria-expanded="false" aria-controls="submenu-pendaftaran-sidang">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm-7 16H6v-2h6v2zm0-4H6v-2h6v2zm0-4H6V9h6v2zm0-4H6V5h6v2zm6 8h-4v-2h4v2zm0-4h-4V9h4v2zm0-4h-4V5h4v2z" />
                </svg>
                Pendaftaran Sidang
            </a>
            <ul class="collapse" id="submenu-pendaftaran-sidang">
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-pendaftaran-proposal" aria-expanded="false" aria-controls="submenu-pendaftaran-proposal">
                        Sidang Proposal
                    </a>
                    <ul class="collapse" id="submenu-pendaftaran-proposal">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('berkas-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('berkas-proposal.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-pendaftaran-skripsi" aria-expanded="false" aria-controls="submenu-pendaftaran-skripsi">
                        Sidang Skripsi
                    </a>
                    <ul class="collapse" id="submenu-pendaftaran-skripsi">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('berkas-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">
                                D3 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('berkas-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('berkas-skripsi.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-jadwal-sidang" aria-expanded="false" aria-controls="submenu-jadwal-sidang">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm-7 16H6v-2h6v2zm0-4H6v-2h6v2zm0-4H6V9h6v2zm0-4H6V5h6v2zm6 8h-4v-2h4v2zm0-4h-4V9h4v2zm0-4h-4V5h4v2z" />
                </svg>
                Jadwal Sidang
            </a>
            <ul class="collapse" id="submenu-jadwal-sidang">
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-jadwal-proposal" aria-expanded="false" aria-controls="submenu-jadwal-proposal">
                        Sidang Proposal
                    </a>
                    <ul class="collapse" id="submenu-jadwal-proposal">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-proposal.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-jadwal-skripsi" aria-expanded="false" aria-controls="submenu-jadwal-skripsi">
                        Sidang Skripsi
                    </a>
                    <ul class="collapse" id="submenu-jadwal-skripsi">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">
                                D3 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('jadwal-skripsi.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('showForm') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2M7 7h2v2H7zm0 4h2v2H7zm0 4h2v2H7zm10 2h-6v-2h6zm0-4h-6v-2h6zm0-4h-6V7h6z" />
                </svg>
                Kelola Formulir
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('showMahasiswa') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 3L1 9l11 6l9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17z" />
                </svg>
                Kelola Data Mahasiswa
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="{{ route('ruangan.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M4.5 20v-1h2V4h8v1h3v14h2v1h-3V6h-2v14zm7-7.23q.31 0 .54-.23t.23-.54t-.23-.54t-.54-.23t-.54.23t-.23.54t.23.54t.54.23" />
                </svg>
                Kelola Ruang Sidang
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-plot-jadwal" aria-expanded="false" aria-controls="submenu-plot-jadwal">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <g fill="none">
                        <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                        <path fill="currentColor" d="M16 3a1 1 0 0 1 1 1v1h2a2 2 0 0 1 1.995 1.85L21 7v12a2 2 0 0 1-1.85 1.995L19 21H5a2 2 0 0 1-1.995-1.85L3 19V7a2 2 0 0 1 1.85-1.995L5 5h2V4a1 1 0 0 1 2 0v1h6V4a1 1 0 0 1 1-1m-1.176 6.379l-4.242 4.242l-1.415-1.414a1 1 0 0 0-1.414 1.414l2.114 2.115a1.01 1.01 0 0 0 1.429 0l4.942-4.943a1 1 0 1 0-1.414-1.414" />
                    </g>
                </svg>
                Kelola Jadwal Sidang
            </a>
            <ul class="collapse" id="submenu-plot-jadwal">
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('plot-jadwal.index', ['prodi'=>'D3 Sistem Informasi']) }}">
                        D3 Sistem Informasi
                    </a>
                </li>
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('plot-jadwal.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                        S1 Sistem Informasi
                    </a>
                </li>
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('plot-jadwal.index', ['prodi'=>'S1 Informatika']) }}">
                        S1 Informatika
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-item text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-hasil-sidang" aria-expanded="false" aria-controls="submenu-hasil-sidang">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm-7 16H6v-2h6v2zm0-4H6v-2h6v2zm0-4H6V9h6v2zm0-4H6V5h6v2zm6 8h-4v-2h4v2zm0-4h-4V9h4v2zm0-4h-4V5h4v2z" />
                </svg>
                Hasil Sidang
            </a>
            <ul class="collapse" id="submenu-hasil-sidang">
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-hasil-proposal" aria-expanded="false" aria-controls="submenu-hasil-proposal">
                        Sidang Proposal
                    </a>
                    <ul class="collapse" id="submenu-hasil-proposal">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-proposal.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-proposal.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-link text-secondary text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-hasil-skripsi" aria-expanded="false" aria-controls="submenu-hasil-skripsi">
                        Sidang Skripsi
                    </a>
                    <ul class="collapse" id="submenu-hasil-skripsi">
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-skripsi.index', ['prodi'=>'D3 Sistem Informasi']) }}">
                                D3 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-skripsi.index', ['prodi'=>'S1 Sistem Informasi']) }}">
                                S1 Sistem Informasi
                            </a>
                        </li>
                        <li>
                            <a class="nav-link text-secondary text-decoration-none fw-semibold" href="{{ route('hasil-skripsi.index', ['prodi'=>'S1 Informatika']) }}">
                                S1 Informatika
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        @endif
    </ul>
</div>