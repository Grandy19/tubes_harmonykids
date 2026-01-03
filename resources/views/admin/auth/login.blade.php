<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - HarmonyKids</title>
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
            font-family: 'Inter', sans-serif;
        }

        .auth-card {
            width: 420px;
            background: white;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.08);
        }

        h4 {
            font-weight: 800;
            color: #0F3974;
        }

        .subtitle {
            font-size: 14px;
            color: #64748B;
        }

        .form-control {
            height: 46px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-primary {
            background: #0F3974;
            border: none;
            height: 46px;
            font-weight: 700;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background: #0C2F5C;
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 700;
            color: #1D4ED8;
            background: #E0E7FF;
            padding: 6px 14px;
            border-radius: 999px;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>

<div class="auth-card">
    <div class="text-center mb-3">
        <div class="admin-badge">
            <i class="fa-solid fa-user-shield"></i> ADMIN SYSTEM
        </div>
        <h4 class="mb-1">Login Admin</h4>
        <p class="subtitle">Kelola sistem HarmonyKids</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.process') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email Admin</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100 mt-3">
            <i class="fa-solid fa-right-to-bracket me-1"></i>
            Masuk Admin
        </button>
    </form>
</div>

</body>
</html>
