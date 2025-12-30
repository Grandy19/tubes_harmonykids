{{-- HEADER (Absolute relative to Content Wrapper) --}}
<div class="header-container">
    <div class="header-bg"></div>
    <img src="{{ asset('assets/images/cloud.png') }}" class="cloud-img" alt="cloud">

    {{-- BAGIAN PROFILE --}}
    <div class="profile-row">
        <a href="{{ route('wali.profile.edit') }}" class="d-flex align-items-center" style="text-decoration: none;">
            
            @php
                $user = Auth::user();
                $foto = ($user && $user->foto_profil) 
                    ? asset('storage/' . $user->foto_profil) 
                    : asset('assets/images/avatar.png');
            @endphp

            <div class="avatar-circle" style="background-image: url('{{ $foto }}');"></div>
            
            <div class="user-info">
                <span class="greeting">Hallo, Selamat Datang!</span>
                <span class="username">{{ $user->name ?? 'Tamu' }}</span>
            </div>
        </a>

        <img src="{{ asset('assets/images/logo.png') }}" class="logo-img" alt="Logo">
    </div>

    {{-- LOKASI DROPDOWN --}}
    <div class="location-bar-wrapper" id="locationWrapper">
        <div class="location-bar" onclick="toggleDropdown()">
            <i class="fa-solid fa-location-dot me-3" style="color: #3577E5; font-size: 24px;"></i>
            <span id="selectedCity" style="flex: 1; font-weight: 700; color: #333;">Pilih Lokasi</span>
            <i id="arrowIcon" class="fa-solid fa-chevron-down" style="color: #64B5F6;"></i>
        </div>
        <div class="dropdown-menu-custom">
            <div class="dropdown-item-custom" onclick="selectCity('Bandung')">Bandung</div>
            <div class="dropdown-item-custom" onclick="selectCity('Bekasi')">Bekasi</div>
            <div class="dropdown-item-custom" onclick="selectCity('Surabaya')">Surabaya</div>
        </div>
    </div>
</div>

{{-- KONTEN SCROLL --}}
<div class="content-scroll">
    {{-- PROMO --}}
    <div class="promo-banner">
        <div class="banner-text-area">
            <div class="banner-quote">“Cari Sekolah Anak Lebih Mudah”</div>
            <a href="#" class="btn-banner">Klik Disini</a>
        </div>
        <img src="{{ asset('assets/images/anak_playground.png') }}" class="banner-img-child" alt="Child">
    </div>

    {{-- GRID MENU --}}
    <div class="menu-grid">
        <a href="{{ route('wali.harmofind') }}" class="menu-item">
            <div class="menu-icon-box"><img src="{{ asset('assets/images/find.png') }}" alt="Find"></div>
            <div class="menu-title">HarmoFind</div>
        </a>
        <a href="{{ route('wali.harmoview') }}" class="menu-item">
            <div class="menu-icon-box"><img src="{{ asset('assets/images/view.png') }}" alt="View"></div>
            <div class="menu-title">HarmoView</div>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon-box"><img src="{{ asset('assets/images/talent.png') }}" alt="Talent"></div>
            <div class="menu-title">HarmoTalent</div>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon-box"><img src="{{ asset('assets/images/talk.png') }}" alt="Talk"></div>
            <div class="menu-title">HarmoTalk</div>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon-box"><img src="{{ asset('assets/images/ride.png') }}" alt="Ride"></div>
            <div class="menu-title">HarmoRide</div>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon-box"><img src="{{ asset('assets/images/tale.png') }}" alt="Tale"></div>
            <div class="menu-title">HarmoTale</div>
        </a>
    </div>

    {{-- REKOMENDASI SECTION --}}
    <div id="rekomendasiSection" style="display:none;">
        <div style="font-size:18px; font-weight:800; color:#0F3974; margin-bottom:15px;">
            Rekomendasi Terbaik
        </div>

        <div id="rekomendasiList"></div>

        <a id="btnSelengkapnya" href="#" class="btn-more">
            Selengkapnya
        </a>
    </div>
    <div style="height: 120px;"></div>
</div>