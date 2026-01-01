@props(['title'])

@push('styles')
<style>
    /* 1. CONTAINER UTAMA HEADER */
    .header-wrapper {
        position: relative;
        height: 240px; /* Sesuai headerHeight Flutter */
        width: 100%;
        overflow: hidden; /* Agar elemen yang keluar batas (seperti lebah) terpotong rapi */
        margin-bottom: -60px; /* Kompensasi tinggi agar konten di bawahnya naik sedikit */
        z-index: 10;
    }

    /* 2. BACKGROUND TEXTURE */
    .header-bg {
        height: 190px; /* headerHeight - 50 */
        width: 100%;
        background-image: url("{{ asset('assets/images/texture.png') }}");
        background-size: cover;
        background-position: center;
        border-bottom-left-radius: 30px; /* Opsional: memberi lengkungan bawah */
        border-bottom-right-radius: 30px;
    }

    /* 3. GAMBAR AWAN (POSISI BAWAH) */
    .header-cloud {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 80px;
        z-index: 2;
    }

    /* 4. KAPSUL JUDUL (POSISI TENGAH) */
    .header-capsule-wrapper {
        position: absolute;
        top: 60px;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        z-index: 5;
    }

    .header-capsule {
        width: 85%; /* MediaQuery width * 0.85 */
        height: 65px;
        background-color: white;
        border-radius: 20px;
        display: flex;
        align-items: center;
        padding: 0 10px;
        
        /* Box Shadow Flutter dikonversi ke CSS */
        box-shadow: 
            0 5px 20px rgba(110, 193, 228, 0.6), /* Glow */
            0 10px 0 #D8D5EA;                  /* Shadow Tebal */
    }

    /* 5. TOMBOL KEMBALI */
    .btn-back {
        background: none;
        border: none;
        padding: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Icon Panah dengan Shadow */
    .icon-back {
        color: #0F3974; /* AppColors.primaryDark */
        font-size: 24px;
        filter: drop-shadow(0.5px 0.5px 0 #0F3974) drop-shadow(-0.2px -0.2px 0 #0F3974);
    }

    /* 6. TEXT JUDUL */
    .header-title {
        flex: 1;
        text-align: center;
        font-family: 'Baloo 2', cursive;
        font-size: 24px;
        font-weight: 800;
        color: #1A73E8; /* AppColors.primary */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding-bottom: 4px; /* Penyesuaian baseline font */
    }

    /* 7. ICON BINTANG KANAN */
    .icon-star {
        color: #FFC107; /* AppColors.accentYellow */
        font-size: 27px;
        margin-right: 8px;
    }

    /* 8. GAMBAR LEBAH (POSISI KIRI ATAS) */
    .header-bee {
        position: absolute;
        top: 35px;
        left: 10px;
        width: 40px;
        transform: rotate(-5.7deg); /* -0.1 radian */
        z-index: 6;
    }

    /* 9. TITIK PUTIH (POSISI KANAN ATAS) */
    .header-dot {
        position: absolute;
        top: 90px;
        right: 15px;
        width: 12px;
        height: 12px;
        background-color: white;
        border-radius: 50%;
        z-index: 4;
    }
</style>
@endpush

<div class="header-wrapper">
    
    {{-- BACKGROUND TEXTURE --}}
    <div class="header-bg"></div>

    {{-- GAMBAR AWAN --}}
    <img src="{{ asset('assets/images/cloud.png') }}" class="header-cloud" alt="Cloud">

    {{-- KAPSUL JUDUL --}}
    <div class="header-capsule-wrapper">
        <div class="header-capsule">
            
            {{-- TOMBOL BACK --}}
            <button onclick="window.location.href='{{ route('wali.home') }}'" class="btn-back">
                <i class="fa-solid fa-chevron-left icon-back"></i>
            </button>

            {{-- JUDUL --}}
            <div class="header-title">
                {{ $title }}
            </div>

            {{-- ICON BINTANG --}}
            <i class="fa-solid fa-star icon-star"></i>

        </div>
    </div>

    {{-- GAMBAR LEBAH --}}
    <img src="{{ asset('assets/images/bee.png') }}" class="header-bee" alt="Bee">

    {{-- TITIK PUTIH --}}
    <div class="header-dot"></div>

</div>