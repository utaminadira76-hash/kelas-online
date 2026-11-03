@extends('layouts.admin')

@section('title', 'Daftar Kelas')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Kelas</h3>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Kelas
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <!-- Form Pencarian -->
            <form action="{{ route('admin.courses.index') }}" method="GET" class="mb-3">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" name="search" class="form-control" placeholder="Cari judul kelas..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Gambar</th>
                            <th>Judul Kelas</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $index => $course)
                            <tr>
                                <td>{{ $courses->firstItem() + $index }}</td>
                                <td>
                                    @if($course->image)
                                        <img src="{{ asset('storage/' . $course->image) }}" alt="Gambar" width="80" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->category->name }}</td>
                                <td>
                                    @if($course->isFree())
                                        <span class="badge bg-success">Gratis</span>
                                    @else
                                        Rp {{ number_format($course->price, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    @if($course->status === \App\Enums\CourseStatus::PUBLISHED)
                                        <span class="badge bg-primary">Published</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning disabled">Edit</a>
                                    <button class="btn btn-sm btn-danger disabled">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-3">Data kelas tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
@endsection