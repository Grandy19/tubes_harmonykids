@extends('pengelola.layout.app')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h3 class="fw-bold">Dashboard Pengelola</h3>
    <p class="text-muted mb-0">
        Ringkasan aktivitas instansi Anda
    </p>
</div>

{{-- INFO INSTANSI --}}
<div class="card card-dashboard mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-1">{{ $instansi['nama'] }}</h5>
            <span class="badge 
                {{ $instansi['status'] === 'approved' ? 'bg-success' : 'bg-warning text-dark' }}">
                Status Instansi: {{ ucfirst($instansi['status']) }}
            </span>
        </div>
        <i class="fa-solid fa-school fa-2x text-primary opacity-50"></i>
    </div>
</div>

{{-- STATISTIK PENDAFTARAN --}}
<div class="row g-4">

    {{-- TOTAL --}}
    <div class="col-md-3">
        <div class="card card-dashboard">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Total Pendaftaran</p>
                        <h4 class="fw-bold">{{ $pendaftaran['total'] }}</h4>
                    </div>
                    <i class="fa-solid fa-users fa-xl text-primary"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- PENDING --}}
    <div class="col-md-3">
        <div class="card card-dashboard">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Menunggu Konfirmasi</p>
                        <h4 class="fw-bold text-warning">
                            {{ $pendaftaran['pending'] }}
                        </h4>
                    </div>
                    <i class="fa-solid fa-clock fa-xl text-warning"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- DITERIMA --}}
    <div class="col-md-3">
        <div class="card card-dashboard">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Diterima</p>
                        <h4 class="fw-bold text-success">
                            {{ $pendaftaran['accepted'] }}
                        </h4>
                    </div>
                    <i class="fa-solid fa-circle-check fa-xl text-success"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- DITOLAK --}}
    <div class="col-md-3">
        <div class="card card-dashboard">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Ditolak</p>
                        <h4 class="fw-bold text-danger">
                            {{ $pendaftaran['rejected'] }}
                        </h4>
                    </div>
                    <i class="fa-solid fa-circle-xmark fa-xl text-danger"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- CTA --}}
@if($pendaftaran['pending'] > 0)
    <div class="alert alert-warning mt-4">
        <i class="fa-solid fa-triangle-exclamation me-2"></i>
        Terdapat <strong>{{ $pendaftaran['pending'] }}</strong> pendaftaran yang
        menunggu konfirmasi.
        <a href="{{ route('pengelola.pendaftaran.index') }}" class="fw-bold ms-1">
            Lihat sekarang
        </a>
    </div>
@endif

@endsection
