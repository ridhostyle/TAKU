<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'sidebar')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .sidebar .navbar-brand {
            display: flex;
            align-items: center;
            padding-left: 20px;
            justify-content: center;
        }

        .sidebar .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .sidebar .nav {
            flex-direction: column;
            padding-left: 20px;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }
    </style>
</head>

<body class="" style="background: #dad7cd">
    <div class="sidebar">
        <div class="d-flex align-content-center justify-content-center">
            <img src="{{ asset('/assets/Logo.png') }}" alt="Logo" width="100px">
        </div>
        <div class="d-flex align-content-center justify-content-center">
            <h2>ADMIN PT</h2>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link" href="/dashboard">
                <i class="fa-solid fa-gauge"></i>
                Dashboard
            </a>
            <a class="nav-link" href="/verifikasi">
                <i class="fa-solid fa-check-to-slot"></i>
                Verifikasi Permohonan
            </a>
            <a class="nav-link" href="/cuti">
                <i class="fa-solid fa-database"></i>
                Data Cuti Pegawai
            </a>
            <a class="nav-link" href="/index">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </nav>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>

</html>
