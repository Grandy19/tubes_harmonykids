@extends('admin.layout.app')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h3 class="fw-bold mb-1">Forum Wali</h3>
    <p class="text-muted mb-0">
        Kelola postingan diskusi yang dibuat oleh wali murid
    </p>
</div>

{{-- STAT RINGKAS --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card card-dashboard">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Postingan</p>
                    <h4 class="fw-bold">{{ $posts->count() }}</h4>
                </div>
                <i class="fa-solid fa-comments fa-xl text-primary opacity-50"></i>
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
                        <th>Wali</th>
                        <th>Konten</th>
                        <th>Like</th>
                        <th class="pe-4 text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($posts as $post)
                    <tr class="forum-row">

                        <td class="ps-4 fw-semibold">
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <div class="fw-semibold">
                                {{ $post->wali->name ?? '-' }}
                            </div>
                        </td>

                        <td class="text-muted">
                            {{ \Illuminate\Support\Str::limit($post->content, 90) }}
                        </td>

                        <td>
                            <span class="badge bg-primary-subtle text-primary">
                                <i class="fa-solid fa-thumbs-up me-1"></i>
                                {{ $post->likes }}
                            </span>
                        </td>

                        <td class="pe-4 text-end">

                            {{-- DELETE --}}
                            <form method="POST"
                                  action="{{ route('admin.forum.delete', $post->id) }}"
                                  class="d-inline"
                                  onsubmit="return confirm('Hapus postingan ini?')">
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
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-comment-slash fa-2x mb-2"></i>
                            <div>Belum ada postingan forum</div>
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
    .forum-row {
        transition: background .2s ease;
    }
    .forum-row:hover {
        background: #F8FAFF;
    }
</style>

@endsection
