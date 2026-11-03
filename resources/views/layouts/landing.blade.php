<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kelas Online') - Platform Belajar Terbaik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .hero { background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover; color: white; padding: 100px 0; }
        .card-course { transition: transform 0.3s; height: 100%; }
        .card-course:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .course-img { height: 200px; object-fit: cover; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('landing.index') }}">Kelas Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.index') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kelas">Kelas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Login Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    @yield('content')

    <!-- Footer -->
    <footer id="kontak" class="bg-dark text-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-1 fw-bold">Lembaga Pelatihan Teknologi</p>
            <p class="mb-1">Email: info@kelasonline.test | WhatsApp: 0812-3456-7890</p>
            <p class="mb-0 text-muted small">&copy; {{ date('Y') }} Kelas Online. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>