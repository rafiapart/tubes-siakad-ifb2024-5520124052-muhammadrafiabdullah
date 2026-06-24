<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - SIAKAD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background-color: #1f2937; }
        .sidebar .nav-link { color: #d1d5db; border-radius: .5rem; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #fff; background-color: #374151; }
        .sidebar .brand { color: #fff; font-weight: 600; }
        .card-stat { border: none; border-radius: .75rem; }
        table th { font-size: .8rem; text-transform: uppercase; color: #6b7280; }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav class="sidebar p-3" style="width: 250px;">
            <div class="brand fs-5 mb-4 px-2">
                <i class="bi bi-mortarboard-fill me-2"></i>SIAKAD
            </div>
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>
                @if (auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dosen.*') ? 'active' : '' }}" href="{{ route('dosen.index') }}">
                            <i class="bi bi-person-badge me-2"></i>Data Dosen
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}" href="{{ route('mahasiswa.index') }}">
                            <i class="bi bi-people me-2"></i>Data Mahasiswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('matakuliah.*') ? 'active' : '' }}" href="{{ route('matakuliah.index') }}">
                            <i class="bi bi-journal-bookmark me-2"></i>Mata Kuliah
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}" href="{{ route('jadwal.index') }}">
                            <i class="bi bi-calendar-week me-2"></i>Jadwal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('krs.all') ? 'active' : '' }}" href="{{ route('krs.all') }}">
                            <i class="bi bi-card-checklist me-2"></i>Semua KRS
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('jadwal.index') ? 'active' : '' }}" href="{{ route('jadwal.index') }}">
                            <i class="bi bi-calendar-week me-2"></i>Jadwal Kuliah
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('krs.index') ? 'active' : '' }}" href="{{ route('krs.index') }}">
                            <i class="bi bi-card-checklist me-2"></i>KRS Saya
                        </a>
                    </li>
                @endif
            </ul>
        </nav>

        <div class="flex-grow-1">
            <nav class="navbar navbar-expand bg-white border-bottom px-4 py-3">
                <span class="fw-semibold">@yield('header', 'Dashboard')</span>
                <div class="ms-auto d-flex align-items-center gap-3">
                    <span class="text-muted small">
                        {{ auth()->user()->name }}
                        <span class="badge bg-secondary text-uppercase">{{ auth()->user()->role }}</span>
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger" type="submit">
                            <i class="bi bi-box-arrow-right"></i> Keluar
                        </button>
                    </form>
                </div>
            </nav>

            <main class="p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
