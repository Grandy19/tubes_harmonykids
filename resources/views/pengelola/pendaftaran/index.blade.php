@extends('pengelola.layout.app')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h3 class="fw-bold">Pendaftaran Wali</h3>
    <p class="text-muted mb-0">
        Daftar pendaftaran anak ke instansi Anda
    </p>
</div>

{{-- TABLE --}}
<div class="card card-dashboard">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Anak</th>
                        <th>Wali</th>
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftaran as $item)
                        @php
                            $badge = [
                                'pending'  => 'warning',
                                'verified' => 'info',
                                'accepted' => 'success',
                                'rejected' => 'danger',
                            ][$item->status] ?? 'secondary';
                        @endphp
                        <tr>
                            <td>{{ $item->nama_anak }}</td>
                            <td>{{ $item->wali->name ?? '-' }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>
                                <span class="badge bg-{{ $badge }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('pengelola.pendaftaran.show', $item->id) }}"
                                   class="btn btn-sm btn-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada pendaftaran
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
