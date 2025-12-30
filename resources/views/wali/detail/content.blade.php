<div class="detail-container">

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
        {{-- Navigasi --}}
        <div class="header-nav">
            <a href="{{ route('wali.home') }}" class="nav-btn">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <button class="nav-btn">
                <i class="fa-regular fa-heart"></i>
            </button>
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

        {{-- Panel Content (DIPISAH KE FOLDER TABS) --}}
        @include('wali.detail.tabs.profil')
        @include('wali.detail.tabs.fasilitas')
        @include('wali.detail.tabs.detail')

    </div>
</div>