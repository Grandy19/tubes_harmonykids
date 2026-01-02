<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>HarmonyKids</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #EAF2FF, #F8FAFC);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Inter', sans-serif;
        }

        .role-wrapper {
            background: white;
            width: 100%;
            max-width: 420px;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.12);
        }

        h2 {
            font-weight: 900;
            color: #0F3974;
            text-align: center;
        }

        p {
            text-align: center;
            color: #64748B;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .role-btn {
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            transition: 0.2s;
            color: #1E293B;
        }

        .role-btn:hover {
            background: #F1F5FF;
            border-color: #3577E5;
        }

        .role-icon {
            font-size: 28px;
            color: #3577E5;
        }

        .role-title {
            font-weight: 800;
        }

        .role-desc {
            font-size: 13px;
            color: #64748B;
        }
    </style>
</head>
<body>

<div class="role-wrapper">
    <h2>HarmonyKids</h2>
    <p>Pilih peran untuk melanjutkan</p>

    {{-- WALI --}}
    <a href="{{ route('wali.welcome') }}" class="role-btn">
        <i class="fa-solid fa-children role-icon"></i>
        <div>
            <div class="role-title">Wali Murid</div>
            <div class="role-desc">Cari & daftarkan anak</div>
        </div>
    </a>

    {{-- PENGELOLA --}}
    <a href="{{ route('pengelola.login') }}" class="role-btn">
        <i class="fa-solid fa-school role-icon"></i>
        <div>
            <div class="role-title">Pengelola Instansi</div>
            <div class="role-desc">Kelola instansi & pendaftaran</div>
        </div>
    </a>

    {{-- ADMIN --}}
    <a href="/admin/login" class="role-btn">
        <i class="fa-solid fa-user-shield role-icon"></i>
        <div>
            <div class="role-title">Admin Sistem</div>
            <div class="role-desc">Verifikasi & monitoring</div>
        </div>
    </a>
</div>

</body>
</html>
