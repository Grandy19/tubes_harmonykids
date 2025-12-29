<x-mobile-app title="Selamat Datang - HarmonyKids" :withNavbar="false">

    {{-- ============================= --}}
    {{-- CSS KHUSUS HALAMAN WELCOME --}}
    {{-- ============================= --}}
    @push('styles')
    <style>
        /* 1. BACKGROUND IMAGE */
        /* Kita taruh di mobile-card, tapi HAPUS display flex-nya */
        /* Biarkan mobile-app.blade.php yang mengatur layoutnya */
        .mobile-card {
            background:
                linear-gradient(rgba(0,0,0,0.15), rgba(0,0,0,0.45)),
                url("{{ asset('assets/images/background.png') }}"),
                linear-gradient(180deg, #0F3974 0%, #2E7CF6 100%);

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* 2. KONTEN UTAMA (YANG MAU DIBAWAH) */
        .bottom-content {
            /* KUNCI POSISI ADA DI SINI: */
            margin-top: auto; /* Dorong elemen ini sampai mentok bawah */
            width: 100%;      /* Pastikan lebar penuh */

            /* Tampilan (Padding & Warna) tetap sesuai request Anda */
            padding: 24px 24px 40px 24px; /* Padding bawah dikurangi dikit biar cantik, sesuaikan jika perlu */
            color: white;
        }

        /* --- SISA CSS TAMPILAN (TIDAK DIUBAH) --- */
        .title-text {
            font-size: 32px;
            font-weight: 600;
            line-height: 1.1;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.35);
        }

        .brand-text {
            font-size: 32px;
            font-weight: 900;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.35);
        }

        .slogan-text {
            font-size: 16px;
            font-weight: 500;
            color: rgba(255,255,255,0.9);
            margin-top: 6px;
            margin-bottom: 32px;
        }

        .btn-custom {
            width: 100%;
            height: 48px;
            background: white;
            color: #0F3974;
            border-radius: 15px;
            font-size: 18px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 10px 0 #D8D5EA;
            margin-bottom: 32px;
            transition: transform 0.1s;
        }

        .btn-custom:active {
            transform: translateY(4px);
            box-shadow: 0 6px 0 #D8D5EA;
        }

        .btn-custom:hover {
            color: #0F3974;
        }

        .btn-last {
            margin-bottom: 0;
        }
    </style>
    @endpush

    {{-- ============================= --}}
    {{-- KONTEN UTAMA --}}
    {{-- ============================= --}}
    <div class="bottom-content">
        <div class="title-text">Selamat Datang</div>
        <div class="d-flex align-items-center flex-wrap">
            <div class="title-text me-2">di</div>
            <div class="brand-text">HarmonyKids</div>
        </div>

        <div class="slogan-text">
            "Langkah kecil hari ini, masa depan cerah esok hari."
        </div>

        {{-- LOGIN --}}
        <a href="{{ route('wali.login') }}" class="btn-custom">

            Masuk
        </a>

        {{-- REGISTER --}}
        <a href="{{ route('wali.register') }}" class="btn-custom btn-last">
            Daftar
        </a>
    </div>
</x-mobile-app>