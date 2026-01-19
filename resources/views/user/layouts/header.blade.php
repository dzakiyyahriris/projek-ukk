<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('landing') }}">
            <i class="bi bi-ticket-perforated-fill me-2"></i>Tiket Asyik
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('landing') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.destinasi') }}">Destinasi</a>
                </li>
            </ul>

            <div class="navbar-nav ms-auto">
                {{-- CEK APAKAH USER SUDAH LOGIN --}}
                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold text-light" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius: 10px;">
                           <li><a class="dropdown-item" href="{{ route('user.orders') }}">Pesanan Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                {{-- TOMBOL LOGOUT --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    {{-- JIKA BELUM LOGIN, TAMPILKAN TOMBOL LOGIN --}}
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-tight me-2 rounded-pill">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-tight rounded-pill">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
