@push('styles')
<style>
    /* =============================================
       HARMOTALE MAIN PAGE 
    ============================================= */

    /* --- 1. PAGE CONTAINER --- */
    .page-container {
        position: relative; 
        width: 100%;
        height: 100vh;
        /* Background warna F9FCFD sesuai permintaan */
        background-color: #F9FCFD;
        overflow: hidden;
    }

    /* --- 2. HEADER LAYER --- */
    .header-layer { 
        position: absolute; top: 0; left: 0; right: 0; z-index: 10; 
    }

    /* --- 3. CONTENT SCROLL --- */
    .content-scroll {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0; 
        overflow-y: auto; 
        padding-top: 250px;
        padding-left: 20px; 
        padding-right: 20px; 
        /* Padding bottom besar agak margin bawah card tidak menabrak awan */
        padding-bottom: 160px;
        z-index: 20; 
        -ms-overflow-style: none; scrollbar-width: none;
    }
    .content-scroll::-webkit-scrollbar { display: none; }

    /* --- 4. INTRO TEXT --- */
    .intro-text {
        text-align: center;
        color: #0F3974;
        font-weight: 800;
        font-size: 15px;
        line-height: 1.55;
        margin-bottom: 24px;
        padding: 0 8px;
    }

    /* --- 5. TALE CARD (Card Biru Utama) --- */
    .tale-card {
        background: #3577E5;
        border-radius: 20px;
        /* Tambah padding bawah dari 24px jadi 80px agar card memanjang ke bawah */
        padding: 16px 16px 80px 16px;
        position: relative;
        /* Drop shadow hitam blur besar seperti gambar referensi */
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* --- 6. WRAPPER GAMBAR --- */
    .tale-img-wrapper {
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        margin-bottom: 24px;
    }

    .tale-img {
        width: 100%;
        height: 190px;
        object-fit: cover;
        display: block;
        border-radius: 12px;
        /* Menggelapkan gambar agar tulisan putihnya lebih jelas terbaca */
        filter: brightness(0.65);
    }

    /* --- 7. JUDUL OVERLAY DI TENGAH GAMBAR --- */
    .tale-title-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        text-align: center;
        color: white;
        font-size: 18px;
        font-weight: 800;
        line-height: 1.3;
        /* Outline & Shadow teks agar terbaca jelas di atas gambar apa saja */
        text-shadow: 
            0px 2px 4px rgba(0,0,0,0.6),
            0px 0px 8px rgba(0,0,0,0.4);
    }

    /* --- 8. COUNTDOWN PILL --- */
    .countdown-pill {
        background: white;
        color: #3577E5; /* Warna teks sesuai referensi */
        font-size: 15px;
        font-weight: 700;
        padding: 12px 28px;
        border-radius: 10px; /* Bentuk pill/kapsul */
        margin-bottom: 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        /* Shadow tipis agar tidak terlihat menyatu dengan card sepenuhnya */
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    /* --- 9. TOMBOL BACA SEKARANG --- */
    .btn-baca {
        background: white;
        color: #0F3974;
        font-size: 15px;
        font-weight: 800;
        padding: 14px 0;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 0 #D8D5EA;
        cursor: pointer;
        text-decoration: none;
        width: 200px; /* Lebar tombol menyesuaikan gambar */
        text-align: center;
        display: block;
        transition: transform 0.1s;
    }
    .btn-baca:hover { background: #fdfdfd; color: #0F3974; text-decoration: none; }
    .btn-baca:active { transform: translateY(2px); box-shadow: 0 2px 0 #D8D5EA; }

    /* --- 10. AWAN BAWAH (di luar card) --- */
    .awan-bawah-page {
        position: absolute;
        bottom: -5px; /* Nempel ke paling bawah layar */
        left: 0;
        width: 100%;
        height: auto;
        /* Buat awan lebih besar agar lebih dominan di bawah */
        transform: scale(1.3);
        transform-origin: bottom center;
        z-index: 50; /* Z-index tinggi agar menutupi / overlap konten scroll & card biru di bawahnya */
        pointer-events: none; /* Supaya klik bisa tembus ke konten di belakang awan kalau perlu */
    }

</style>
@endpush
