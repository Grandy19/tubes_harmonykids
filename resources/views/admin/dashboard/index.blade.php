@extends('admin.layout.app')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h3 class="fw-bold">Dashboard Admin</h3>
    <p class="text-muted mb-0">
        Ringkasan sistem HarmonyKids
    </p>
</div>

{{-- RINGKASAN SISTEM --}}
<div class="row g-4">

    {{-- TOTAL USER --}}
    <div class="col-md-4">
        <div class="card card-dashboard">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Pengguna</p>
                        <h4 class="fw-bold">{{ $totalUsers }}</h4>
                    </div>
                    <i class="fa-solid fa-users fa-2x text-primary opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- TOTAL INSTANSI --}}
    <div class="col-md-4">
        <div class="card card-dashboard">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Instansi</p>
                        <h4 class="fw-bold">{{ $totalInstansi }}</h4>
                    </div>
                    <i class="fa-solid fa-school fa-2x text-success opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- PENDING INSTANSI --}}
    <div class="col-md-4">
        <div class="card card-dashboard">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Menunggu Konfirmasi</p>
                        <h4 class="fw-bold text-warning">
                            {{ $pendingInstansi }}
                        </h4>
                    </div>
                    <i class="fa-solid fa-clock fa-2x text-warning opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ALERT JIKA ADA INSTANSI PENDING --}}
@if($pendingInstansi > 0)
    <div class="alert alert-warning mt-4">
        <i class="fa-solid fa-triangle-exclamation me-2"></i>
        Terdapat <strong>{{ $pendingInstansi }}</strong> instansi yang
        menunggu verifikasi.
        <a href="{{ route('admin.instansi') }}" class="fw-bold ms-1">
            Tinjau sekarang
        </a>
    </div>
@endif

@endsection
