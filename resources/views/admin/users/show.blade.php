@extends('admin.layout.app')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h3 class="fw-bold mb-1">Detail Pengguna</h3>
    <p class="text-muted mb-0">
        Informasi lengkap akun pengguna
    </p>
</div>

{{-- CARD --}}
<div class="card card-dashboard">
    <div class="card-body">

        <div class="row g-4">

            <div class="col-md-6">
                <p class="text-muted mb-1">Nama Lengkap</p>
                <h6 class="fw-bold">{{ $user->name }}</h6>
            </div>

            <div class="col-md-6">
                <p class="text-muted mb-1">Email</p>
                <h6 class="fw-bold">{{ $user->email }}</h6>
            </div>

            <div class="col-md-6">
                <p class="text-muted mb-1">Role</p>
                <span class="badge
                    {{ $user->role === 'admin' ? 'bg-danger' :
                       ($user->role === 'pengelola' ? 'bg-primary' : 'bg-success') }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>

            <div class="col-md-6">
                <p class="text-muted mb-1">Tanggal Daftar</p>
                <h6 class="fw-bold">
                    {{ $user->created_at->format('d M Y') }}
                </h6>
            </div>

        </div>

        <hr class="my-4">

        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>

    </div>
</div>

@endsection
