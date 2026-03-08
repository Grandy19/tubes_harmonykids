<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    {{-- Viewport wajib untuk Mobile App agar tidak bisa di-zoom user (terasa seperti native app) --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>{{ $title ?? 'HarmonyKids' }}</title>

    {{-- CSS Libraries --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet"> 
    
    {{-- Favicon (Opsional: Pastikan file ada) --}}
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}">

    {{-- JS Libraries --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @props(['title', 'withNavbar' => true])

    <style>
        :root {
            --app-max-width: 480px; /* Lebar maksimal simulasi HP di Desktop */
            --app-bg: #F9FCFD;
            --body-bg: #E0E5EC;
            --navbar-height: 70px; /* Tinggi navbar bawah (estimasi) */
        }

        /* 1. RESET BODY - Kunci Scroll di Body Utama */
        html, body {
            margin: 0; padding: 0;
            width: 100%; height: 100%;
            background-color: var(--body-bg);
            font-family: 'Baloo 2', cursive;
            overflow: hidden; /* PENTING: Mencegah scroll ganda */
            /* Center di Desktop */
            display: flex; justify-content: center; align-items: center;
        }

        /* 2. APP SHELL - Frame Utama */
        .mobile-card {
            background-color: var(--app-bg);
        
            width: 100%;
            max-width: 420px;        /* ⬅️ KUNCI LEBAR */
            height: 100%;
            height: 100dvh;
        
            position: relative;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        /* 3. MODE DESKTOP - Simulasi HP */
        @media (min-width: 768px) {
            .mobile-card {
                height: 100vh;
                border-radius: 24px;
                border: 3px solid #b3b3b3;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            }
        }

        /* 4. CONTENT WRAPPER - Area yang BISA DI-SCROLL */
        .content-wrapper {
            flex: 1; /* Mengisi sisa ruang antara header (jika ada) dan navbar */
            width: 100%;
            overflow-y: auto; /* Aktifkan Scroll Vertikal */
            overflow-x: hidden;
            
            /* Agar scroll terasa native di iOS */
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
            
            /* Sembunyikan Scrollbar tapi tetap bisa scroll */
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE */
            
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .content-wrapper::-webkit-scrollbar { display: none; /* Chrome/Safari */ }

        /* 5. NAVBAR CONTAINER - Area Tetap di Bawah */
        .navbar-container {
            flex-shrink: 0; /* Tidak boleh mengecil */
            width: 100%;
            background: white;
            z-index: 100;
            position: relative;
            /* Border atas tipis pemisah konten */
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        /* 6. SAFE AREA HANDLING (Poni & Home Bar) */
        /* Padding atas untuk menghindari Poni HP (Notch) pada konten */
        .safe-top-padding {
            padding-top: env(safe-area-inset-top);
        }
        
        /* Padding bawah untuk menghindari Home Bar iPhone */
        .safe-bottom-padding {
            padding-bottom: env(safe-area-inset-bottom);
            background-color: white; 
        }

        /* 7. LOADING OVERLAY */
        .loading-overlay {
            position: absolute; inset: 0;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(5px);
            z-index: 9999;
            display: none; /* Hidden by default */
            align-items: center; justify-content: center;
            flex-direction: column;
            gap: 15px;
        }
        .loading-text { font-weight: 700; color: #3577E5; }

    </style>

    @stack('styles')
</head>
<body>

    <div class="mobile-card">
        
        {{-- GLOBAL LOADING --}}
        <div id="globalLoading" class="loading-overlay">
            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
            <div class="loading-text">Memuat...</div>
        </div>

        {{-- AREA SCROLL (KONTEN UTAMA) --}}
        {{-- Tambahkan class safe-top-padding agar konten paling atas tidak ketabrak Poni HP --}}
        <div class="content-wrapper safe-top-padding">
            
            {{-- Slot Konten Halaman --}}
            {{ $slot }}

            {{-- Spacer: Jika tidak ada navbar, kasih jarak bawah agar tidak mepet layar --}}
            @if(!$withNavbar)
                <div style="height: 40px;"></div>
            @endif

        </div>

        {{-- AREA TETAP (NAVBAR BAWAH) --}}
        @if($withNavbar)
            <div class="navbar-container">
                {{-- Komponen Navbar --}}
                <x-bottom-nav />
                
                {{-- Spacer untuk Home Bar iPhone (Garis Bawah Layar) --}}
                <div class="safe-bottom-padding" style="height: env(safe-area-inset-bottom);"></div>
            </div>
        @endif

    </div>

    @stack('scripts')

    <script>
        // Fungsi Global Loading
        window.showLoading = () => document.getElementById('globalLoading').style.display = 'flex';
        window.hideLoading = () => document.getElementById('globalLoading').style.display = 'none';

        // Auto hide loading saat halaman selesai dimuat (opsional)
        window.addEventListener('load', () => {
            // Uncomment jika ingin loading otomatis hilang saat load page
            // hideLoading(); 
        });
    </script>

</body>
</html>