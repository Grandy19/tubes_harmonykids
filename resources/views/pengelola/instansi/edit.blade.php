@extends('pengelola.layout.app')

@section('content')
<div class="container-fluid">

    {{-- JUDUL --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Profil Instansi</h3>
        <p class="text-muted mb-0">Kelola data instansi yang Anda kelola</p>
    </div>

    <div class="card card-dashboard">
        <div class="card-body p-4">

            <div class="alert alert-info small mb-4">
                <i class="fa-solid fa-circle-info me-2"></i>
                Setiap pengelola hanya dapat mengelola <b>satu instansi</b>.
            </div>

            {{-- 🔥 PENTING: enctype --}}
            <form method="POST"
                  action="{{ route('pengelola.instansi.update') }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- NAMA --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Instansi</label>
                    <input type="text" class="form-control"
                           value="{{ $instansi->nama }}" readonly>
                </div>

                {{-- JENIS --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Instansi</label>
                    <select name="jenis" class="form-select">
                        <option value="TK/PG" {{ $instansi->jenis === 'TK/PG' ? 'selected' : '' }}>TK / PG</option>
                        <option value="Daycare" {{ $instansi->jenis === 'Daycare' ? 'selected' : '' }}>Daycare</option>
                    </select>
                </div>

                {{-- LOKASI --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Lokasi</label>
                    <select name="lokasi" class="form-select">
                        @foreach(['Bandung','Bekasi','Surabaya'] as $kota)
                            <option value="{{ $kota }}" {{ $instansi->lokasi === $kota ? 'selected' : '' }}>
                                {{ $kota }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- BIAYA --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Biaya Pendaftaran</label>
                    <input type="number" name="biaya_pendaftaran"
                           class="form-control"
                           value="{{ $instansi->biaya_pendaftaran }}">
                </div>

                {{-- JENIS PEMBAYARAN --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Pembayaran</label>
                    <select name="jenis_pembayaran" class="form-select" required>
                        <option value="">-- Pilih Bank --</option>
                        <option value="BCA" {{ $instansi->jenis_pembayaran === 'BCA' ? 'selected' : '' }}>BCA</option>
                        <option value="BNI" {{ $instansi->jenis_pembayaran === 'BNI' ? 'selected' : '' }}>BNI</option>
                        <option value="BRI" {{ $instansi->jenis_pembayaran === 'BRI' ? 'selected' : '' }}>BRI</option>
                    </select>
                </div>

                {{-- JAM --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jam Operasional</label>
                    <input type="text" name="jam_operasional"
                           class="form-control"
                           value="{{ $instansi->jam_operasional }}">
                </div>

                {{-- KONTAK --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Telepon</label>
                        <input type="text" name="telepon"
                               class="form-control"
                               value="{{ $instansi->telepon }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email"
                               class="form-control"
                               value="{{ $instansi->email }}">
                    </div>
                </div>

                {{-- SEKILAS --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Sekilas Tentang Kami</label>
                    <textarea name="sekilas_tentang_kami"
                              class="form-control"
                              rows="4">{{ optional($instansi->profile)->sekilas_tentang_kami }}</textarea>
                </div>

                {{-- PROGRAM --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Program Pembelajaran</label>
                    <textarea name="program_pembelajaran"
                              rows="4"
                              class="form-control">{{ optional($instansi->profile)->program_pembelajaran }}</textarea>
                </div>

                <div class="alert alert-warning small">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                    Upload galeri bersifat <b>replace</b>.  
                    Foto lama akan dihapus dan diganti dengan foto baru.
                </div>

                {{-- ===================== --}}
                {{-- 🔥 GALERI GAMBAR --}}
                {{-- ===================== --}}
                <div class="mb-4">
                    <h5 class="fw-bold mb-3">Galeri Instansi</h5>

                {{-- FOTO UTAMA --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Foto Utama <span class="text-muted">(1 foto)</span>
                    </label>
                    <input type="file"
                        name="gallery[utama]"
                        class="form-control"
                        accept="image/*">
                </div>

                {{-- GALERI PROFIL (MAX 2) --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Galeri Profil <span class="text-muted">(Max 2 foto)</span>
                    </label>
                    <input type="file"
                        name="gallery[profil][]"
                        class="form-control"
                        multiple
                        accept="image/*">
                    <small class="text-muted">
                        Upload ulang akan <b>mengganti seluruh galeri profil</b>
                    </small>
                </div>

                {{-- GALERI FASILITAS --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Fasilitas <span class="text-muted">(Max 4 foto)</span>
                    </label>
                    <input type="file"
                        name="gallery[fasilitas][]"
                        class="form-control"
                        multiple
                        accept="image/*">
                    <small class="text-muted">
                        Maksimal 4 foto, upload ulang akan mengganti data lama
                    </small>
                </div>

                {{-- GALERI SDM --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Guru & Staff <span class="text-muted">(Max 4 foto)</span>
                    </label>
                    <input type="file"
                        name="gallery[sdm][]"
                        class="form-control"
                        multiple
                        accept="image/*">
                    <small class="text-muted">
                        Foto akan ditampilkan di halaman wali
                    </small>
                </div>

                {{-- ACTION --}}
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary px-4">
                        <i class="fa-solid fa-save me-2"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
