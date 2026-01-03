@extends('admin.layout.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Detail Instansi</h3>
        <p class="text-muted mb-0">
            Informasi lengkap instansi terdaftar
        </p>
    </div>

    <a href="{{ route('admin.instansi') }}" class="btn btn-light">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
</div>

{{-- STATUS --}}
<div class="card card-dashboard mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1">{{ $instansi->nama }}</h5>

            <span class="badge
                {{ $instansi->status === 'approved' ? 'bg-success' :
                   ($instansi->status === 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                Status: {{ ucfirst($instansi->status) }}
            </span>
        </div>

        <i class="fa-solid fa-school fa-2x text-primary opacity-50"></i>
    </div>
</div>

{{-- INFORMASI UTAMA --}}
<div class="row g-4 mb-4">

    {{-- DATA INSTANSI --}}
    <div class="col-md-6">
        <div class="card card-dashboard h-100">
            <div class="card-body">
                <h6 class="fw-bold mb-3">
                    <i class="fa-solid fa-building me-1"></i> Data Instansi
                </h6>

                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-muted">Nama</td>
                        <td class="fw-semibold">{{ $instansi->nama }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jenis</td>
                        <td>{{ $instansi->jenis }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Lokasi</td>
                        <td>{{ $instansi->lokasi }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jam Operasional</td>
                        <td>{{ $instansi->jam_operasional }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Biaya Pendaftaran</td>
                        <td>
                            Rp {{ number_format($instansi->biaya_pendaftaran,0,',','.') }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- DATA PENGELOLA --}}
    <div class="col-md-6">
        <div class="card card-dashboard h-100">
            <div class="card-body">
                <h6 class="fw-bold mb-3">
                    <i class="fa-solid fa-user me-1"></i> Pengelola
                </h6>

                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-muted">Nama</td>
                        <td class="fw-semibold">
                            {{ $instansi->user->name ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email</td>
                        <td>{{ $instansi->user->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Telepon</td>
                        <td>{{ $instansi->telepon }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email Instansi</td>
                        <td>{{ $instansi->email }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- DESKRIPSI --}}
@if($instansi->profile && $instansi->profile->sekilas_tentang_kami)
<div class="card card-dashboard mb-4">
    <div class="card-body">
        <h6 class="fw-bold mb-2">
            <i class="fa-solid fa-circle-info me-1"></i> Sekilas Tentang Instansi
        </h6>
        <p class="text-muted mb-0">
            {{ $instansi->profile->sekilas_tentang_kami }}
        </p>
    </div>
</div>
@endif

{{-- AKSI ADMIN --}}
<div class="card card-dashboard">
    <div class="card-body d-flex justify-content-between align-items-center">

        <div class="text-muted">
            Tindakan admin terhadap instansi ini
        </div>

        <div class="d-flex gap-2">

            @if($instansi->status === 'pending')
                <form method="POST"
                      action="{{ route('admin.instansi.approve', $instansi->id) }}">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success">
                        <i class="fa-solid fa-check me-1"></i> Approve
                    </button>
                </form>
            @endif

            <form method="POST"
                  action="{{ route('admin.instansi.delete', $instansi->id) }}"
                  onsubmit="return confirm('Yakin ingin menghapus instansi ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger">
                    <i class="fa-solid fa-trash me-1"></i> Hapus
                </button>
            </form>

        </div>

    </div>
</div>

@endsection
