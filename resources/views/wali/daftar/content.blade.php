<div class="page-container">
    
    {{-- LAYER 1: HERO IMAGE --}}
    <div class="hero-layer">
        @php
            $bg = $instansi->galleries->first() 
                ? asset('storage/'.$instansi->galleries->first()->image_path) 
                : 'https://via.placeholder.com/400x300';
        @endphp
        <img src="{{ $bg }}" class="hero-img">
        <div class="hero-overlay"></div>
    </div>

    {{-- LAYER 2: HEADER & INFO --}}
    <div class="header-layer">
        <div class="header-nav">
            {{-- Tombol Kembali ke Detail --}}
            <a href="{{ route('wali.instansi.detail', $instansi->id) }}" class="nav-btn">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>

        <div class="hero-info">
            <div class="instansi-title">{{ $instansi->nama }}</div>
            <div class="instansi-loc">
                <i class="fa-solid fa-location-dot"></i> {{ \Illuminate\Support\Str::limit($instansi->lokasi, 50) }}
            </div>
        </div>
    </div>

    {{-- LAYER 3: FORM CONTENT (SCROLLABLE) --}}
    <div class="content-layer">
        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="instansi_id" value="{{ $instansi->id }}">

            {{-- INPUT FIELDS --}}
            <div class="input-group-custom">
                <i class="fa-solid fa-child input-icon"></i>
                <input type="text" name="nama_anak" class="form-control-custom" placeholder="Nama Lengkap Anak" required>
            </div>
            
            <div class="input-group-custom">
                <i class="fa-solid fa-calendar-day input-icon"></i>
                <input type="text" name="ttl" class="form-control-custom" placeholder="Tanggal Lahir" onfocus="(this.type='date')" onblur="(this.type='text')" required>
            </div>
            
            <div class="input-group-custom">
                <i class="fa-solid fa-venus-mars input-icon"></i>
                <select name="jenis_kelamin" class="form-control-custom" required>
                    <option value="" disabled selected>Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
            </div>
            
            <div class="input-group-custom">
                <i class="fa-solid fa-praying-hands input-icon"></i>
                <select name="agama" class="form-control-custom" required>
                    <option value="" disabled selected>Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Budha</option>
                </select>
                <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
            </div>
            
            <div class="input-group-custom">
                <i class="fa-solid fa-map-location-dot input-icon"></i>
                <input type="text" name="alamat" class="form-control-custom" placeholder="Alamat Tempat Tinggal" required>
            </div>
            
            <div class="input-group-custom">
                <i class="fa-solid fa-notes-medical input-icon"></i>
                <input type="text" name="riwayat_kesehatan" class="form-control-custom" placeholder="Riwayat Kesehatan (Opsional)">
            </div>
            
            <div class="input-group-custom">
                <i class="fa-solid fa-flag input-icon"></i>
                <input type="text" name="kewarganegaraan" class="form-control-custom" value="Indonesia" placeholder="Kewarganegaraan" required>
            </div>

            {{-- PEMBAYARAN --}}
            <div class="payment-label">
                Transfer Pembayaran Ke Rekening Berikut
            </div>

            @php
                $namaBank = strtolower($instansi->nama_bank ?? 'mandiri');
                $noRek = $instansi->no_rekening ?? '890212909';
                $atasNama = $instansi->atas_nama_rekening ?? $instansi->user->name ?? 'Pengelola';
                
                $logoBank = match($namaBank) {
                    'bca' => asset('assets/images/bca.png'),
                    'bni' => asset('assets/images/bni.png'),
                    'bri' => asset('assets/images/bri.png'),
                    default => 'https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.png',
                };

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
                    <div>{{ strtoupper($namaBank) }} - {{ Str::limit($atasNama, 15) }}</div>
                    <div>{{ $noRek }}</div>
                    <div>Rp {{ number_format($instansi->biaya_pendaftaran ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>

            {{-- UPLOAD --}}
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