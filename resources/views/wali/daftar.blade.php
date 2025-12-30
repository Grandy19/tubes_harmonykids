<x-mobile-app title="Formulir Pendaftaran" :withNavbar="false">

@push('styles')
<style>
    /* --- LAYOUT UTAMA --- */
    body { background-color: #F8FAFC; }
    .form-container { position: relative; padding-bottom: 40px; min-height: 100vh; }

    /* --- HERO HEADER --- */
    .hero-layer { position: relative; height: 260px; width: 100%; }
    .hero-img { width: 100%; height: 100%; object-fit: cover; }
    .hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%); }
    
    .btn-back {
        position: absolute; top: 24px; left: 24px;
        width: 40px; height: 40px; background: rgba(255,255,255,0.9);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        color: #3577E5; font-size: 18px; z-index: 10; text-decoration: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .hero-info { position: absolute; bottom: 50px; left: 24px; right: 24px; text-align: center; color: white; z-index: 5; }
    .instansi-name { font-size: 22px; font-weight: 800; margin-bottom: 4px; text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
    .instansi-addr { font-size: 12px; opacity: 0.9; font-weight: 500; }

    /* --- FORM CONTENT --- */
    .form-content {
        position: relative; margin-top: -30px; background: white;
        border-radius: 30px 30px 0 0; padding: 30px 24px; z-index: 20;
        box-shadow: 0 -5px 20px rgba(0,0,0,0.05);
    }

    /* --- INPUT --- */
    .input-group-custom {
        background: white; border: 1px solid #E2E8F0; border-radius: 16px;
        padding: 0 16px; height: 55px; display: flex; align-items: center;
        margin-bottom: 16px; transition: 0.2s;
    }
    .input-group-custom:focus-within { border-color: #3577E5; box-shadow: 0 4px 15px rgba(53, 119, 229, 0.1); }
    .input-icon { width: 24px; text-align: center; color: #3577E5; margin-right: 12px; font-size: 16px; }
    .form-control-custom { flex: 1; border: none; outline: none; font-weight: 600; color: #334155; font-size: 13px; background: transparent; width: 100%; }
    .form-control-custom::placeholder { color: #94A3B8; font-weight: 500; }
    select.form-control-custom { appearance: none; -webkit-appearance: none; cursor: pointer; }
    .dropdown-arrow { color: #94A3B8; font-size: 12px; pointer-events: none; }

    /* --- PAYMENT CARD (DINAMIS) --- */
    .payment-label { font-size: 13px; font-weight: 700; color: #0F172A; margin: 24px 0 12px; }
    
    /* Warna card berubah sesuai bank (Opsional, atau biarkan biru default) */
    .payment-card {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
        border-radius: 20px; padding: 20px; display: flex; align-items: center; gap: 16px;
        color: white; margin-bottom: 16px; box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
    }
    
    /* Bank BCA Style (Contoh Variasi Warna) */
    .payment-card.bca { background: linear-gradient(135deg, #005EB8 0%, #003B73 100%); }
    /* Bank BNI Style */
    .payment-card.bni { background: linear-gradient(135deg, #F15A23 0%, #C63F0F 100%); }
    /* Bank BRI Style */
    .payment-card.bri { background: linear-gradient(135deg, #00529C 0%, #00386B 100%); }

    .bank-logo-box {
        width: 50px; height: 50px; background: white; border-radius: 12px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .bank-logo-box img { width: 35px; object-fit: contain; }
    
    .rek-info div:nth-child(1) { font-size: 12px; font-weight: 500; opacity: 0.9; text-transform: uppercase; } /* Nama Bank & Pemilik */
    .rek-info div:nth-child(2) { font-size: 16px; font-weight: 800; margin: 2px 0 4px; letter-spacing: 1px; font-family: monospace; } /* No Rek */
    .rek-info div:nth-child(3) { font-size: 14px; font-weight: 700; color: #FFD700; } /* Nominal */

    /* --- UPLOAD --- */
    .upload-box {
        background: #F8FAFC; border: 1px dashed #CBD5E1; border-radius: 16px;
        padding: 12px 16px; display: flex; align-items: center; justify-content: space-between;
        cursor: pointer; transition: 0.2s;
    }
    .upload-box:active { background: #EFF6FF; border-color: #3577E5; }
    .btn-pilih-file { background: #3577E5; color: white; font-size: 11px; font-weight: 700; padding: 8px 14px; border-radius: 8px; border: none; cursor: pointer; }
    .file-name { font-size: 12px; color: #64748B; margin-left: 10px; flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    /* --- SUBMIT --- */
    .btn-submit {
        display: block; width: 100%; height: 55px; background: #3577E5; color: white;
        border-radius: 16px; font-size: 16px; font-weight: 800; margin-top: 32px;
        cursor: pointer; box-shadow: 0 10px 25px rgba(53, 119, 229, 0.25); border:none; transition: 0.2s;
    }
    .btn-submit:active { transform: scale(0.98); }
</style>
@endpush

<div class="form-container">
    <div class="hero-layer">
        @php
            $bg = $instansi->galleries->first() 
                ? asset('storage/'.$instansi->galleries->first()->image_path) 
                : 'https://via.placeholder.com/400x300';
        @endphp
        <img src="{{ $bg }}" class="hero-img">
        <div class="hero-overlay"></div>
        <a href="{{ route('wali.instansi.detail', $instansi->id) }}" class="btn-back"><i class="fa-solid fa-chevron-left"></i></a>
        <div class="hero-info">
            <div class="instansi-name">{{ $instansi->nama }}</div>
            <div class="instansi-addr">{{ \Illuminate\Support\Str::limit($instansi->lokasi, 50) }}</div>
        </div>
    </div>

    <div class="form-content">
        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="instansi_id" value="{{ $instansi->id }}">

            {{-- INPUT FIELDS --}}
            <div class="input-group-custom"><i class="fa-solid fa-child input-icon"></i><input type="text" name="nama_anak" class="form-control-custom" placeholder="Nama Lengkap Anak" required></div>
            <div class="input-group-custom"><i class="fa-solid fa-calendar-day input-icon"></i><input type="text" name="ttl" class="form-control-custom" placeholder="Tanggal Lahir" onfocus="(this.type='date')" onblur="(this.type='text')" required></div>
            <div class="input-group-custom"><i class="fa-solid fa-venus-mars input-icon"></i><select name="jenis_kelamin" class="form-control-custom" required><option value="" disabled selected>Jenis Kelamin</option><option value="L">Laki-laki</option><option value="P">Perempuan</option></select><i class="fa-solid fa-chevron-down dropdown-arrow"></i></div>
            <div class="input-group-custom"><i class="fa-solid fa-praying-hands input-icon"></i><select name="agama" class="form-control-custom" required><option value="" disabled selected>Agama</option><option value="Islam">Islam</option><option value="Kristen">Kristen</option><option value="Katolik">Katolik</option><option value="Hindu">Hindu</option><option value="Budha">Budha</option></select><i class="fa-solid fa-chevron-down dropdown-arrow"></i></div>
            <div class="input-group-custom"><i class="fa-solid fa-map-location-dot input-icon"></i><input type="text" name="alamat" class="form-control-custom" placeholder="Alamat Tempat Tinggal" required></div>
            <div class="input-group-custom"><i class="fa-solid fa-notes-medical input-icon"></i><input type="text" name="riwayat_kesehatan" class="form-control-custom" placeholder="Riwayat Kesehatan (Opsional)"></div>
            <div class="input-group-custom"><i class="fa-solid fa-flag input-icon"></i><input type="text" name="kewarganegaraan" class="form-control-custom" value="Indonesia" placeholder="Kewarganegaraan" required></div>

            {{-- LOGIKA PEMBAYARAN DINAMIS --}}
            <div class="payment-label">
                Transfer Pembayaran Ke Rekening Berikut
            </div>

            @php
                // Ambil data bank dari database, default ke Mandiri jika kosong
                $namaBank = strtolower($instansi->nama_bank ?? 'mandiri');
                $noRek = $instansi->no_rekening ?? '890212909';
                $atasNama = $instansi->atas_nama_rekening ?? $instansi->user->name ?? 'Pengelola';
                
                // Tentukan Logo berdasarkan nama bank
                // Pastikan Anda punya file logo di public/assets/images/
                $logoBank = match($namaBank) {
                    'bca' => asset('assets/images/bca.png'),
                    'bni' => asset('assets/images/bni.png'),
                    'bri' => asset('assets/images/bri.png'),
                    default => 'https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.png', // Default Mandiri Online
                };

                // Tentukan Class CSS tambahan untuk warna card (Opsional)
                $cardClass = match($namaBank) {
                    'bca' => 'bca',
                    'bni' => 'bni',
                    'bri' => 'bri',
                    default => '',
                };
            @endphp

            <div class="payment-card {{ $cardClass }}">
                <div class="bank-logo-box">
                    <img src="{{ $logoBank }}" alt="{{ $namaBank }}">
                </div>
                <div class="rek-info">
                    {{-- Nama Bank & Pemilik --}}
                    <div>{{ strtoupper($namaBank) }} - {{ Str::limit($atasNama, 15) }}</div>
                    
                    {{-- Nomor Rekening --}}
                    <div>{{ $noRek }}</div>
                    
                    {{-- Nominal Biaya --}}
                    <div>Rp {{ number_format($instansi->biaya_pendaftaran ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>

            {{-- UPLOAD BUKTI --}}
            <div class="upload-box" onclick="document.getElementById('fileUpload').click()">
                <div style="display:flex; align-items:center; flex:1;">
                    <i class="fa-solid fa-file-invoice input-icon" style="margin-left: 5px;"></i>
                    <div class="file-name" id="fileNameDisplay">Upload Bukti Transfer</div>
                </div>
                <div class="btn-pilih-file">Pilih File</div>
                <input type="file" name="bukti_pembayaran" id="fileUpload" hidden accept="image/*" onchange="updateFileName(this)" required>
            </div>

            <button type="submit" class="btn-submit">Daftar Sekarang</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function updateFileName(input) {
        const display = document.getElementById('fileNameDisplay');
        if (input.files && input.files.length > 0) {
            display.textContent = input.files[0].name;
            display.style.color = '#334155';
            display.style.fontWeight = '600';
        } else {
            display.textContent = 'Upload Bukti Transfer';
            display.style.fontWeight = 'normal';
        }
    }
</script>
@endpush

</x-mobile-app>