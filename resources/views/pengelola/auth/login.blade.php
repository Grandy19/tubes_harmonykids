<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Pengelola - HarmonyKids</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #F1F5F9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            width: 420px;
            background: white;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        h4 {
            font-weight: 800;
            color: #0F3974;
        }
        .btn-primary {
            background: #0F3974;
            border: none;
        }
    </style>
</head>
<body>

<div class="auth-card">
    <h4 class="mb-2">Login Pengelola</h4>
    <p class="text-muted mb-4">Kelola instansi Anda di HarmonyKids</p>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('pengelola.login.process') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email Instansi</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100 mt-3">
            <i class="fa-solid fa-right-to-bracket me-1"></i> Login
        </button>
    </form>

    <div class="text-center mt-4">
        <small>Belum punya akun?</small><br>
        <a href="{{ route('pengelola.register') }}" class="fw-bold">
            Daftar sebagai Pengelola
        </a>
    </div>
</div>

</body>
</html>
