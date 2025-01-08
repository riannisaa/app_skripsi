<nav class="navbar custom-orange-navbar fixed-top navbar-expand-lg z-3" style=" height: 5rem;">
    <div class="container">
        <a class="navbar-brand" style="color: white;">Sistem Informasi Tugas Akhir</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
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