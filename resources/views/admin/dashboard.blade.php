@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h3 class="mb-4 fw-bold">Ringkasan Dashboard</h3>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Kelas</h6>
                    <h2 class="fw-bold mb-0">{{ $totalCourses }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Pendaftar</h6>
                    <h2 class="fw-bold mb-0">{{ $totalRegistrations }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0 fw-bold">5 Pendaftar Terbaru</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRegistrations as $reg)
                            <tr>
                                <td>{{ $reg->name }}</td>
                                <td>{{ $reg->course->title ?? '-' }}</td>
                                <td>{{ $reg->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-3 text-muted">Belum ada pendaftar</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection