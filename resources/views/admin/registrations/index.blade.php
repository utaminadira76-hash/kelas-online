@extends('layouts.admin')

@section('title', 'Daftar Pendaftar')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Daftar Pendaftar</h3>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <!-- Form Pencarian -->
            <form action="{{ route('admin.registrations.index') }}" method="GET" class="mb-3">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama</th>
                            <th>Email / Telepon</th>
                            <th>Kelas yang Diikuti</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th width="200">Ubah Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $index => $reg)
                            <tr>
                                <td>{{ $registrations->firstItem() + $index }}</td>
                                <td class="fw-bold">{{ $reg->name }}</td>
                                <td>
                                    {{ $reg->email }}<br>
                                    <small class="text-muted">{{ $reg->phone }}</small>
                                </td>
                                <td>
                                    {{ $reg->course->title ?? '-' }}<br>
                                    <small class="text-muted">{{ $reg->course->category->name ?? '' }}</small>
                                </td>
                                <td>{{ $reg->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    @if($reg->status === \App\Enums\RegistrationStatus::PENDING)
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($reg->status === \App\Enums\RegistrationStatus::DITERIMA)
                                        <span class="badge bg-success">Diterima</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.registrations.update-status', $reg->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group input-group-sm">
                                            <select name="status" class="form-select" onchange="this.form.submit()">
                                                <option value="pending" {{ $reg->status->value == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="diterima" {{ $reg->status->value == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                <option value="ditolak" {{ $reg->status->value == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-3">Belum ada data pendaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $registrations->links() }}
            </div>
        </div>
    </div>
@endsection