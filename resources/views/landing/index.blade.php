@extends('layouts.landing')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Tingkatkan Skill Teknologimu</h1>
            <p class="lead mb-4">Belajar langsung dari praktisi ahli. Pilih kelas impianmu dan mulai karier barumu hari ini.</p>
            <a href="#kelas" class="btn btn-primary btn-lg px-4">Lihat Kelas</a>
        </div>
    </section>

    <!-- Daftar Kelas Section -->
    <section id="kelas" class="py-5">
        <div class="container">
            <div class="row mb-4 align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold mb-0">Kelas Terbaru</h2>
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <!-- Form Pencarian & Filter Kategori -->
                    <form action="{{ route('landing.index') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari kelas..." value="{{ request('search') }}">
                        <select name="category" class="form-select" style="width: auto;" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-outline-primary">Cari</button>
                    </form>
                </div>
            </div>

            <div class="row g-4">
                @forelse($courses as $course)
                    <div class="col-md-4">
                        <div class="card card-course shadow-sm border-0 h-100">
                            @if($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top course-img" alt="{{ $course->title }}">
                            @else
                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center text-white course-img">
                                    <span>Tidak ada gambar</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <span class="badge bg-info text-dark mb-2">{{ $course->category->name }}</span>
                                <h5 class="card-title fw-bold">{{ $course->title }}</h5>
                                <p class="card-text text-muted small mb-3">
                                    <i class="bi bi-person"></i> {{ $course->instructor }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">
                                        @if($course->isFree())
                                            Gratis
                                        @else
                                            Rp {{ number_format($course->price, 0, ',', '.') }}
                                        @endif
                                    </span>
                                    <a href="{{ route('landing.show', $course->slug) }}" class="btn btn-sm btn-primary">Detail Kelas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h5 class="text-muted">Tidak ada kelas yang cocok dengan pencarian Anda.</h5>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Landing Page -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $courses->links() }}
            </div>
        </div>
    </section>
@endsection