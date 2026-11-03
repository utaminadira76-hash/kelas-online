@extends('layouts.landing')

@section('title', $course->title)

@section('content')
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('landing.index') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $course->title }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Kolom Kiri: Detail Kelas -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm">
                    @if($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="{{ $course->title }}" style="max-height: 400px; object-fit: cover;">
                    @endif
                    <div class="card-body p-4">
                        <span class="badge bg-info text-dark mb-2">{{ $course->category->name }}</span>
                        <h1 class="fw-bold mb-3">{{ $course->title }}</h1>
                        
                        <div class="d-flex gap-4 mb-4 text-muted">
                            <span><i class="bi bi-person"></i> Instruktur: <strong>{{ $course->instructor }}</strong></span>
                            <span><i class="bi bi-tag"></i> Harga: 
                                <strong>
                                    @if($course->isFree())
                                        Gratis
                                    @else
                                        Rp {{ number_format($course->price, 0, ',', '.') }}
                                    @endif
                                </strong>
                            </span>
                        </div>

                        <hr>
                        <h4 class="fw-bold mb-3">Deskripsi Kelas</h4>
                        <p style="white-space: pre-line; line-height: 1.8;">{{ $course->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Form Pendaftaran -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 80px;">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0 fw-bold text-center">Daftar Kelas Ini</h5>
                    </div>
                    <div class="card-body p-4">
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('landing.register', $course->slug) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Daftar Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection