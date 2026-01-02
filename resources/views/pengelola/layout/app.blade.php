<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengelola - HarmonyKids</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- FontAwesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #F1F5F9;
            font-family: 'Inter', sans-serif;
        }

        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: #0F3974;
            color: #fff;
        }

        .sidebar h5 {
            font-weight: 800;
        }

        .sidebar a {
            color: #CBD5E1;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            font-weight: 600;
            border-radius: 8px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        .card-dashboard {
            border: none;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.04);
        }
    </style>
</head>
<body>

<div class="dashboard-wrapper">
    {{-- SIDEBAR --}}
    @include('pengelola.layout.sidebar')

    {{-- CONTENT --}}
    <div class="content">
        @yield('content')
    </div>
</div>

</body>
</html>
