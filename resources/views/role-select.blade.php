<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Peran - HarmonyKids</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1A73E8;
            --secondary: #64748B;
            --accent: #FFC107;
            --bg-brand: linear-gradient(135deg, #1A73E8 0%, #0B3D91 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff;
            margin: 0;
            overflow-x: hidden;
        }

        /* --- LAYOUT UTAMA (SPLIT SCREEN) --- */
        .main-container {
            min-height: 100vh;
            display: flex;
            flex-direction: row; /* Default Desktop: Sebelahan */
        }

        /* 1. BAGIAN KIRI (BRANDING) */
        .brand-panel {
            flex: 1; /* Ambil sisa ruang di desktop */
            background: var(--bg-brand);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
            padding: 40px;
        }

        /* Dekorasi Pattern Bergerak (Biar Unik) */
        .brand-pattern {
            position: absolute;
            width: 150%;
            height: 150%;
            background-image: radial-gradient(rgba(255,255,255,0.1) 2px, transparent 2px);
            background-size: 30px 30px;
            animation: movePattern 60s linear infinite;
        }

        .brand-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 500px;
        }

        .logo-icon {
            font-size: 80px;
            color: var(--accent);
            margin-bottom: 20px;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));
            animation: float 4s ease-in-out infinite;
        }

        .brand-title {
            font-family: 'Baloo 2', cursive;
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .brand-tagline {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* 2. BAGIAN KANAN (ACTION/FORM) */
        .action-panel {
            width: 550px; /* Lebar fix di desktop biar rapi */
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            box-shadow: -10px 0 40px rgba(0,0,0,0.05);
            z-index: 10;
        }

        /* --- STYLING KOMPONEN --- */
        .section-title h3 {
            font-family: 'Baloo 2', cursive;
            font-weight: 800;
            color: #1e293b;
            font-size: 24px;
        }

        .role-card {
            display: flex;
            align-items: center;
            padding: 20px;
            margin-bottom: 16px;
            background: #fff;
            border: 2px solid #F1F5F9;
            border-radius: 20px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        /* Warna Unik Tiap Role */
        .role-wali:hover { border-color: #3B82F6; background: #EFF6FF; }
        .role-pengelola:hover { border-color: #10B981; background: #ECFDF5; }
        .role-admin:hover { border-color: #6366F1; background: #EEF2FF; }

        .icon-box {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 18px;
            transition: transform 0.3s;
        }

        /* Icon Colors Default */
        .role-wali .icon-box { background: #E0F2FE; color: #0284C7; }
        .role-pengelola .icon-box { background: #D1FAE5; color: #059669; }
        .role-admin .icon-box { background: #E0E7FF; color: #4F46E5; }

        .role-info h4 {
            font-size: 17px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 4px 0;
        }

        .role-info p {
            font-size: 13px;
            color: #64748B;
            margin: 0;
        }

        .arrow-indicator {
            margin-left: auto;
            color: #CBD5E1;
            transition: 0.3s;
        }

        /* Hover Effects */
        .role-card:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.06); }
        .role-card:hover .icon-box { transform: scale(1.1) rotate(5deg); }
        .role-card:hover .arrow-indicator { transform: translateX(5px); color: inherit; }

        /* --- RESPONSIVE MOBILE (THE MAGIC) --- */
        @media (max-width: 992px) {
            .main-container {
                flex-direction: column; /* Stack jadi Atas-Bawah */
            }

            .brand-panel {
                flex: none;
                height: 35vh; /* Header pendek di HP */
                padding: 30px 20px;
                border-bottom-right-radius: 40px;
                border-bottom-left-radius: 40px;
            }

            .logo-icon { font-size: 50px; margin-bottom: 10px; }
            .brand-title { font-size: 2rem; }
            .brand-tagline { font-size: 0.9rem; display: none; } /* Sembunyikan tagline di HP biar bersih */

            .action-panel {
                width: 100%;
                flex: 1;
                padding: 30px 24px;
                margin-top: -30px; /* Overlap effect */
                background: transparent; /* Biar nyatu */
                box-shadow: none;
            }

            /* Container khusus di HP biar kayak card melayang */
            .mobile-form-container {
                background: white;
                padding: 24px;
                border-radius: 30px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            }
        }

        @keyframes movePattern { from { background-position: 0 0; } to { background-position: 100px 100px; } }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    </style>
</head>
<body>

<div class="main-container">
    
    <div class="brand-panel">
        <div class="brand-pattern"></div>
        <div class="brand-content">
            <i class="fa-solid fa-shapes logo-icon"></i>
            <div class="brand-title">HarmonyKids</div>
            <div class="brand-tagline">
                Platform digital untuk memantau tumbuh kembang anak<br>dan manajemen sekolah masa kini.
            </div>
        </div>
    </div>

    <div class="action-panel">
        
        <div class="mobile-form-container">
            <div class="section-title mb-4">
                <h3>Selamat Datang! 👋</h3>
                <p class="text-secondary small">Silakan pilih akses masuk Anda</p>
            </div>

            <a href="{{ route('wali.welcome') }}" class="role-card role-wali">
                <div class="icon-box">
                    <i class="fa-solid fa-children"></i>
                </div>
                <div class="role-info">
                    <h4>Wali Murid</h4>
                    <p>Cari sekolah & pantau anak</p>
                </div>
                <i class="fa-solid fa-chevron-right arrow-indicator"></i>
            </a>

            <a href="{{ route('pengelola.login') }}" class="role-card role-pengelola">
                <div class="icon-box">
                    <i class="fa-solid fa-school"></i>
                </div>
                <div class="role-info">
                    <h4>Pengelola Instansi</h4>
                    <p>Manajemen data sekolah</p>
                </div>
                <i class="fa-solid fa-chevron-right arrow-indicator"></i>
            </a>

            <a href="{{ route('admin.login') }}" class="role-card role-admin">
                <div class="icon-box">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div class="role-info">
                    <h4>Admin Sistem</h4>
                    <p>Kontrol panel administrator</p>
                </div>
                <i class="fa-solid fa-chevron-right arrow-indicator"></i>
            </a>

            <div class="text-center mt-4 text-muted" style="font-size: 12px;">
                &copy; {{ date('Y') }} HarmonyKids App
            </div>
        </div>

    </div>
</div>

</body>
</html>