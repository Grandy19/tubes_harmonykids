<div id="detail" class="tab-panel">
    
    {{-- INFORMASI UMUM --}}
    <div class="stat-row">
        <div class="stat-card">
            <img src="{{ asset('assets/images/biaya.png') }}" class="stat-icon">
            <div class="stat-label">Biaya Pendaftaran</div>
            <div class="stat-val">Rp {{ number_format($instansi->biaya_pendaftaran, 0, ',', '.') }} /Bulan</div>
        </div>
        <div class="stat-card">
            <img src="{{ asset('assets/images/jam.png') }}" class="stat-icon">
            <div class="stat-label">Jam Operasional</div>
            <div class="stat-val">{{ $instansi->jam_operasional }}</div>
        </div>
    </div>

    <div class="section-label">Kontak & Alamat</div>
    
    <a href="tel:{{ $instansi->telepon ?? '' }}" style="text-decoration:none; color:inherit;">
        <div class="contact-row">
            <div style="display:flex;align-items:center">
                <div class="c-icon"><i class="fa-solid fa-phone"></i></div>
                <div class="c-info">
                    <div>Nomor Telepon</div>
                    <div>{{ $instansi->telepon ?? '-' }}</div>
                </div>
            </div>
            <i class="fa-solid fa-chevron-right" style="color:#CBD5E1;"></i>
        </div>
    </a>

    <a href="mailto:{{ $instansi->email }}" style="text-decoration:none; color:inherit;">
        <div class="contact-row">
            <div style="display:flex;align-items:center">
                <div class="c-icon"><i class="fa-solid fa-envelope"></i></div>
                <div class="c-info">
                    <div>Email</div>
                    <div>{{ $instansi->email }}</div>
                </div>
            </div>
            <i class="fa-solid fa-chevron-right" style="color:#CBD5E1;"></i>
        </div>
    </a>

    {{-- TOMBOL DAFTAR --}}
    <a href="{{ route('pendaftaran.create', $instansi->id) }}" class="btn-daftar">
        Daftar Sekarang
    </a>
</div>