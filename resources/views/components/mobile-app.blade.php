<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $title ?? 'HarmonyKids' }}</title>

    {{-- CSS Libraries --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- JS Libraries --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- PROPS: Menangkap konfigurasi (Title & Navbar) --}}
    @props(['title', 'withNavbar' => true])

    <style>
        /* 1. LAYOUT LUAR (Style Asli Anda) */
        body {
            background-color: #E0E5EC;
            font-family: 'Baloo 2', cursive;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            /* overflow: hidden; -> Saya hapus biar behavior asli browser tetap ada */
        }

        /* 2. FRAME HP (Style Asli Anda + Flexbox System) */
        .mobile-card {
            width: 100%;
            max-width: 420px;
            
            /* Style Asli Anda */
            min-height: 100vh;
            background-color: #F9FCFD;
            position: relative;
            
            /* --- PENAMBAHAN WAJIB AGAR LAYOUT RAPI --- */
            /* Tanpa ini, footer tidak akan terdorong ke bawah */
            display: flex;          
            flex-direction: column; 
            overflow: hidden; 
        }

        /* Desktop preview (Style Asli Anda) */
        @media (min-width: 500px) {
            body {
                padding: 40px 0;
            }
            .mobile-card {
                /* Style Asli Anda */
                min-height: 850px; 
                /* Tinggi fix biar app-shell scrollnya jalan benar di desktop */
                height: 850px;     
                
                border-radius: 20px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
            }
        }

        /* 3. AREA KONTEN (Style Baru untuk Scroll & Flex) */
        .content-wrapper {
            flex: 1;                /* Ambil sisa ruang */
            overflow-y: auto;       /* Scroll hidup di sini */
            overflow-x: hidden;
            width: 100%;
            
            /* Flexbox support untuk child (biar mt-auto jalan) */
            display: flex;          
            flex-direction: column; 
            
            /* Sembunyikan Scrollbar */
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .content-wrapper::-webkit-scrollbar { 
            width: 0; height: 0; 
        }

        .loading-overlay {
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,0.7);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }
    </style>

    @stack('styles')
</head>
<body>

    <div class="mobile-card">
        {{-- GLOBAL LOADING --}}
        <div id="globalLoading" class="loading-overlay">
            <div class="spinner-border text-primary"></div>
        </div>

        {{-- AREA SCROLL --}}
        {{-- Jika withNavbar=true, tambah padding bawah 120px --}}
        <div class="content-wrapper {{ $withNavbar ? 'pb-[120px]' : '' }}">
            {{ $slot }}
        </div>

        {{-- NAVBAR STICKY (KONDISIONAL) --}}
        @if($withNavbar)
            <x-bottom-nav />
        @endif

    </div>

    @stack('scripts')

    <script>
        window.showLoading = () => document.getElementById('globalLoading').style.display = 'flex';
        window.hideLoading = () => document.getElementById('globalLoading').style.display = 'none';
    </script>

</body>
</html>