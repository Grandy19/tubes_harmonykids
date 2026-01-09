<div class="detail-container">

    {{-- LAYER 1: HERO IMAGE + OVERLAY GELAP --}}
    <div class="hero-layer">
        @php
            $bg = $instansi->galleryUtama
                ? asset('storage/' . $instansi->galleryUtama->image_path)
                : 'https://via.placeholder.com/400x300';

            $isLiked = auth()->user()
                ->likedInstansis
                ->contains($instansi->id);
        @endphp
        
        {{-- Gambar Asli --}}
        <img src="{{ $bg }}" class="hero-img">
        
        {{-- INI YANG HILANG KEMARIN: DIV UNTUK GELAPNYA --}}
        <div class="hero-overlay"></div> 
    </div>

    {{-- LAYER 2: HEADER & INFO --}}
    <div class="header-layer">
        {{-- Navigasi --}}
        <div class="header-nav">
            <a href="{{ route('wali.home') }}" class="nav-btn">
                <i class="fa-solid fa-chevron-left"></i>
            </a>

            <form action="{{ route('wali.instansi.like', $instansi->id) }}" method="POST">
                @csrf
                <button type="submit" class="nav-btn">
                    <i class="fa-{{ $isLiked ? 'solid' : 'regular' }} fa-heart"></i>
                </button>
            </form>
        </div>

        {{-- Info Teks --}}
        <div class="hero-info">
            <div class="instansi-title">{{ $instansi->nama }}</div>
            <div class="instansi-loc">
                <i class="fa-solid fa-location-dot"></i> {{ $instansi->lokasi }}
            </div>
            <div class="rating-badge">
                <i class="fa-solid fa-star" style="color: #FACC15"></i> 5.0
            </div>
        </div>
    </div>

    {{-- LAYER 3: CONTENT SCROLL --}}
    <div class="content-layer">
        
        {{-- Tabs --}}
        <div class="tabs-box">
            <button class="tab-btn active" onclick="switchTab('profil', this)">Profil</button>
            <button class="tab-btn" onclick="switchTab('fasilitas', this)">Fasilitas</button>
            <button class="tab-btn" onclick="switchTab('detail', this)">Detail</button>
        </div>

        {{-- Panel Content --}}
        @include('wali.detail.tabs.profil')
        @include('wali.detail.tabs.fasilitas')
        @include('wali.detail.tabs.detail')

        {{-- Spacer Bawah (Biar tombol daftar ga ketutupan pas scroll mentok) --}}
        <div style="height: 100px;"></div>
    </div>
</div>