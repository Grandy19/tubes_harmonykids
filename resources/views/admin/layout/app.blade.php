<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - HarmonyKids</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap & Icon --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    {{-- Admin Style --}}
    <style>
        body {
            margin: 0;
            background: #F1F5F9;
            font-family: 'Inter', sans-serif;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #0F3974, #0C2F5C);
            color: white;
            padding: 24px;
        }

        .sidebar h5 {
            font-weight: 900;
            margin-bottom: 28px;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: block;
            color: rgba(255,255,255,.85);
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 8px;
            font-weight: 600;
            transition: .2s;
        }

        .sidebar a i {
            width: 20px;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,.15);
            color: white;
        }

        .sidebar a.active {
            background: white;
            color: #0F3974;
            font-weight: 800;
        }

        .sidebar hr {
            border-color: rgba(255,255,255,.2);
            margin: 20px 0;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 32px;
        }
    </style>
</head>
<body>

<div class="admin-wrapper">

    {{-- SIDEBAR ADMIN --}}
    <aside class="sidebar">
        <h5>HarmonyKids</h5>

        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line me-2"></i> Dashboard
        </a>

        <a href="{{ route('admin.users') }}"
           class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="fa-solid fa-users me-2"></i> Users
        </a>

        <a href="{{ route('admin.instansi') }}"
           class="{{ request()->routeIs('admin.instansi*') ? 'active' : '' }}">
            <i class="fa-solid fa-school me-2"></i> Instansi
        </a>

        <a href="{{ route('admin.forum') }}"
           class="{{ request()->routeIs('admin.forum*') ? 'active' : '' }}">
            <i class="fa-solid fa-comments me-2"></i> Forum
        </a>

        <hr>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="btn btn-link text-start text-white p-0">
                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
            </button>
        </form>
    </aside>

    {{-- CONTENT --}}
    <main class="content">
        @yield('content')
    </main>

</div>

</body>
</html>
