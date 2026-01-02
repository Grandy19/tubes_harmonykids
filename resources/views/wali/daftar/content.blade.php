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
            <a href="{{ route('wali.instansi.detail', $instansi->id) }}" class="nav-btn">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>

        <div class="hero-info">
            <div class="instansi-title">{{ $instansi->nama }}</div>
            <div class="instansi-loc">
                <i class="fa-solid fa-location-dot"></i>
                {{ \Illuminate\Support\Str::limit($instansi->lokasi, 50) }}
            </div>
        </div>
    </div>

    {{-- LAYER 3: FORM --}}
    <div class="content-layer">
        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="instansi_id" value="{{ $instansi->id }}">

            {{-- INPUT --}}
            <div class="input-group-custom">
                <i class="fa-solid fa-child input-icon"></i>
                <input type="text" name="nama_anak" class="form-control-custom" placeholder="Nama Lengkap Anak" required>
            </div>

            <div class="input-group-custom">
                <i class="fa-solid fa-calendar-day input-icon"></i>
                <input type="text" name="ttl" class="form-control-custom"
                       placeholder="Tanggal Lahir"
                       onfocus="this.type='date'"
                       onblur="this.type='text'" required>
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
                <input type="text" name="riwayat_kesehatan" class="form-control-custom"
                       placeholder="Riwayat Kesehatan (Opsional)">
            </div>

            <div class="input-group-custom">
                <i class="fa-solid fa-flag input-icon"></i>
                <input type="text" name="kewarganegaraan"
                       class="form-control-custom"
                       value="Indonesia" required>
            </div>

            {{-- PEMBAYARAN --}}
            <div class="payment-label">Transfer Pembayaran Ke Rekening Berikut</div>

            @php
                $bank = strtolower($instansi->jenis_pembayaran ?? 'bca');
                $logoBank = match($bank) {
                    'bca' => asset('assets/images/bca.png'),
                    'bni' => asset('assets/images/bni.png'),
                    'bri' => asset('assets/images/bri.png'),
                    default => asset('assets/images/bca.png'),
                };
                $cardClass = match($bank) {
                    'bca' => 'bca',
                    'bni' => 'bni',
                    'bri' => 'bri',
                    default => '',
                };
                $atasNama = $instansi->user->name ?? 'Pengelola';
            @endphp

            <div class="payment-card {{ $cardClass }}">
                <div class="bank-logo-box">
                    <img src="{{ $logoBank }}" alt="{{ strtoupper($bank) }}">
                </div>
                <div class="rek-info">
                    <div>{{ strtoupper($bank) }} - {{ Str::limit($atasNama, 20) }}</div>
                    <div>Biaya Pendaftaran</div>
                    <div>Rp {{ number_format($instansi->biaya_pendaftaran, 0, ',', '.') }}</div>
                </div>
            </div>

            {{-- UPLOAD --}}
            <div class="upload-box" onclick="document.getElementById('fileUpload').click()">
                <div style="display:flex;align-items:center;flex:1;">
                    <i class="fa-solid fa-file-invoice input-icon"></i>
                    <div class="file-name" id="fileNameDisplay">Upload Bukti Transfer</div>
                </div>
                <div class="btn-pilih-file">Pilih File</div>
                <input type="file" name="bukti_pembayaran" id="fileUpload"
                       hidden accept="image/*" onchange="updateFileName(this)" required>
            </div>

            <button type="submit" class="btn-submit">Daftar Sekarang</button>
        </form>
    </div>
</div>
    {{-- POPUP SUCCESS --}}
    @if(session('success'))
    <div class="frame-popup-overlay" id="successPopup">
        <div class="frame-popup-card">
            <div class="popup-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h3>Berhasil</h3>
            <p>{{ session('success') }}</p>
            <button onclick="closePopup()">OK</button>
        </div>
    </div>
    @endif