@extends('admin.layout.app')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h3 class="fw-bold mb-1">Manajemen Instansi</h3>
    <p class="text-muted mb-0">
        Klik instansi untuk melihat detail lengkap
    </p>
</div>

{{-- STAT RINGKAS --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card card-dashboard">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Instansi</p>
                    <h4 class="fw-bold">{{ $instansis->count() }}</h4>
                </div>
                <i class="fa-solid fa-school fa-xl text-primary opacity-50"></i>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success d-flex align-items-center mb-4">
        <i class="fa-solid fa-circle-check me-2"></i>
        {{ session('success') }}
    </div>
@endif

{{-- TABLE --}}
<div class="card card-dashboard">
    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light text-muted">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Nama Instansi</th>
                        <th>Pengelola</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th class="pe-4 text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($instansis as $instansi)
                    <tr class="instansi-row"
                        onclick="window.location='{{ route('admin.instansi.show', $instansi->id) }}'">

                        <td class="ps-4 fw-semibold">
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <div class="fw-semibold text-primary">
                                {{ $instansi->nama }}
                            </div>
                            <small class="text-muted">
                                Klik untuk detail
                            </small>
                        </td>

                        <td class="text-muted">
                            {{ $instansi->user->name ?? '-' }}
                        </td>

                        <td>
                            <span class="badge bg-secondary-subtle text-secondary">
                                {{ $instansi->jenis }}
                            </span>
                        </td>

                        <td>
                            @if($instansi->status === 'pending')
                                <span class="badge bg-warning-subtle text-warning">
                                    Pending
                                </span>
                            @elseif($instansi->status === 'approved')
                                <span class="badge bg-success-subtle text-success">
                                    Approved
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger">
                                    Rejected
                                </span>
                            @endif
                        </td>

                        <td class="pe-4 text-end">

                            {{-- APPROVE --}}
                            @if($instansi->status === 'pending')
                                <form method="POST"
                                      action="{{ route('admin.instansi.approve', $instansi->id) }}"
                                      class="d-inline"
                                      onclick="event.stopPropagation()">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-success">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                            @endif

                            {{-- DELETE --}}
                            <form method="POST"
                                  action="{{ route('admin.instansi.delete', $instansi->id) }}"
                                  class="d-inline"
                                  onclick="event.stopPropagation()"
                                  onsubmit="return confirm('Hapus instansi ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-school-circle-xmark fa-2x mb-2"></i>
                            <div>Belum ada instansi</div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- STYLE --}}
<style>
    .instansi-row {
        cursor: pointer;
        transition: background .2s ease;
    }
    .instansi-row:hover {
        background: #F1F5FF;
    }
</style>

@endsection
