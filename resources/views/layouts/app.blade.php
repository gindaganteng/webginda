<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Home') - SMKN 4 Kota Bogor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>

    <header class="navbar">
        <div class="container nav">
            <a href="{{ route('home') }}" class="brand">SMKN 4 KOTA BOGOR</a>
            <input type="checkbox" id="nav-toggle" class="nav-toggle" aria-label="Buka menu">
            <nav class="nav-menu" aria-label="Menu utama">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profile</a>
                <a href="{{ route('artikel') }}" class="{{ request()->routeIs('artikel') ? 'active' : '' }}">Artikel</a>
                <a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'active' : '' }}">Galeri</a>
                <a href="{{ route('produk') }}" class="{{ request()->routeIs('produk') ? 'active' : '' }}">Produk</a>
                <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
            </nav>
            <a href="{{ url('/login') }}" class="btn btn-primary">Login Admin</a>
            <label for="nav-toggle" class="nav-burger">&#9776;</label>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container foot-grid">
            <div>
                <a href="{{ route('home') }}" class="foot-brand">SMKN 4 KOTA BOGOR</a>
                <p>Sekolah menengah kejuruan yang mencetak generasi profesional, berakhlak, dan berprestasi di tingkat internasional.</p>
                <div class="socials">
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
            <div>
                <h4 class="foot-title yellow">Navigasi</h4>
                <ul class="foot-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('profil') }}">Profil</a></li>
                    <li><a href="{{ route('artikel') }}">Artikel</a></li>
                    <li><a href="{{ route('galeri') }}">Galeri</a></li>
                </ul>
            </div>
            <div>
                <h4 class="foot-title yellow">Informasi</h4>
                <ul class="foot-contact">
                    <li><i class="fa-solid fa-location-dot"></i><span>Jl. Raya Tajur Kp. Buntar, Muarasari, Bogor Selatan, Kota Bogor</span></li>
                    <li><i class="fa-solid fa-phone"></i><span>+62 821 226 2442</span></li>
                    <li><i class="fa-regular fa-envelope"></i><span>info@smkn4bogor.sch.id</span></li>
                </ul>
            </div>
            <div>
                <h4 class="foot-title yellow">Jam Operasional</h4>
                <ul class="jam">
                    <li><span>Senin - Jumat:</span><span>07.00 - 16.00 WIB</span></li>
                    <li><span>Sabtu:</span><span>07.00 - 13.00 WIB</span></li>
                    <li class="tutup"><span>Minggu:</span><span>Tutup</span></li>
                </ul>
            </div>
        </div>
        <div class="foot-bottom">&copy; {{ date('Y') }} SMKN 4 Kota Bogor. Semua Hak Dilindungi.</div>
    </footer>

    @stack('scripts')
</body>
</html>