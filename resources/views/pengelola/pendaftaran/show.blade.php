@extends('pengelola.layout.app')

@section('content')
<h4 class="mb-4">Detail Pendaftaran</h4>

<div class="card">
    <div class="card-body">

        <p><strong>Nama Anak:</strong> {{ $pendaftaran->nama_anak }}</p>
        <p><strong>Wali:</strong> {{ $pendaftaran->wali->name }}</p>

        <p><strong>Bukti Pembayaran:</strong></p>
        <img src="{{ asset('storage/'.$pendaftaran->bukti_pembayaran) }}"
             class="img-fluid rounded border mb-4"
             style="max-width: 400px;">

        <div class="d-flex gap-2">

            {{-- VERIFIKASI --}}
            @if($pendaftaran->status === 'pending')
                <form method="POST"
                      action="{{ route('pengelola.pendaftaran.verify', $pendaftaran->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-warning">
                        Verifikasi
                    </button>
                </form>
            @endif

            {{-- TERIMA --}}
            @if($pendaftaran->status === 'verified')
                <form method="POST"
                      action="{{ route('pengelola.pendaftaran.accept', $pendaftaran->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">
                        Terima
                    </button>
                </form>

                <form method="POST"
                      action="{{ route('pengelola.pendaftaran.reject', $pendaftaran->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">
                        Tolak
                    </button>
                </form>
            @endif

        </div>

    </div>
</div>
@endsection
