<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Admin SMKN 4 Kota Bogor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body class="admin-body">
<div class="admin-shell">

    <aside class="sidebar">
        <div class="side-head">
            <strong>Admin Panel</strong>
            <span>SMKN 4 BOGOR</span>
        </div>

        <nav class="side-nav" aria-label="Menu admin">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-table-cells-large"></i> Dashboard</a>
            <a href="{{ route('admin.artikel') }}" class="{{ request()->routeIs('admin.artikel*') ? 'active' : '' }}"><i class="fa-regular fa-newspaper"></i> Artikel</a>
            <a href="#"><i class="fa-solid fa-bag-shopping"></i> Produk</a>
            <a href="#"><i class="fa-regular fa-images"></i> Galeri</a>
        </nav>

        <div class="side-foot">
            <div class="side-user">
                <span class="avatar"><i class="fa-solid fa-user-tie"></i></span>
                <div>
                    <strong>{{ Auth::user()->name ?? 'Admin Utama' }}</strong>
                    <span>Super Admin</span>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="side-logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</button>
            </form>
        </div>
    </aside>

    <div class="admin-main">
        @hasSection('header_custom')
            @yield('header_custom')
        @else
            <header class="admin-top">
                <div>
                    <h1>@yield('heading', 'Dashboard Overview')</h1>
                    <p>@yield('subheading')</p>
                </div>
                <div class="top-right">
                    <button type="button" class="icon-btn" aria-label="Notifikasi"><i class="fa-regular fa-bell"></i></button>
                    <span class="top-divider" aria-hidden="true"></span>
                    <span class="top-date">{{ now()->locale('id')->translatedFormat('d F Y') }} <i class="fa-regular fa-calendar"></i></span>
                </div>
            </header>
        @endif

        <div class="admin-content">
            @yield('content')
        </div>

        <footer class="admin-foot">&copy; {{ date('Y') }} SMKN 4 KOTA BOGOR. All rights reserved.</footer>
    </div>

</div>
@stack('scripts')
</body>
</html>