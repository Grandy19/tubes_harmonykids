@extends('admin.layout.app')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h3 class="fw-bold mb-1">Manajemen Pengguna</h3>
    <p class="text-muted mb-0">
        Daftar seluruh pengguna yang terdaftar di sistem HarmonyKids
    </p>
</div>

{{-- STAT RINGKAS --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card card-dashboard">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Pengguna</p>
                    <h4 class="fw-bold">{{ $users->count() }}</h4>
                </div>
                <i class="fa-solid fa-users fa-xl text-primary opacity-50"></i>
            </div>
        </div>
    </div>
</div>

{{-- TABLE CARD --}}
<div class="card card-dashboard">
    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light text-muted">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="pe-4">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="user-row clickable"
                            onclick="window.location='{{ route('admin.users.show', $user->id) }}'">

                            <td class="ps-4 fw-semibold">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <div class="fw-semibold text-dark">
                                    {{ $user->name }}
                                </div>
                            </td>

                            <td class="text-muted">
                                {{ $user->email }}
                            </td>

                            <td>
                                <span class="badge
                                    {{ $user->role === 'admin' ? 'bg-danger-subtle text-danger' :
                                       ($user->role === 'pengelola' ? 'bg-primary-subtle text-primary' :
                                       'bg-success-subtle text-success') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td class="pe-4 text-muted">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-user-slash fa-2x mb-2"></i>
                                <div>Belum ada pengguna terdaftar</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- STYLE KHUSUS --}}
<style>
    .user-row {
        transition: background .2s ease;
    }

    .user-row:hover {
        background: #F8FAFF;
    }

    .clickable {
        cursor: pointer;
    }
</style>

@endsection
