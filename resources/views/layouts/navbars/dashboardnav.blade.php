<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDashboard" aria-controls="navbarDashboard" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarDashboard">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @if(auth()->user()->role === 'pasien')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.pasien') }}">Home</a>
                    </li>
                @elseif(auth()->user()->role === 'dokter')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.dokter') }}">Home</a>
                    </li>
                @elseif(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.admin') }}">Home</a>
                    </li>
                @endif
                @if(auth()->user()->role === 'pasien')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pasien.reservations.index') }}">Reservasi Saya</a>
                    </li>
                @elseif(auth()->user()->role === 'dokter')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dokter.reservations.index') }}">Reservasi Masuk</a>
                    </li>
                @elseif(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.reservations.index') }}">Manajemen Reservasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">Manajemen Akun</a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav> 