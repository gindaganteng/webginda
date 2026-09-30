<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - SMKN 4 Kota Bogor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-page">
    <div class="login-deco" aria-hidden="true"></div>

    <main class="login-box">
        <div class="login-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 4 Kota Bogor">
        </div>
        <h1>Login Admin</h1>
        <p class="login-sub">SMKN 4 KOTA BOGOR</p>

        <div class="login-card">
            <form method="POST" action="{{ route('login.proses') }}" class="login-form" novalidate>
                @csrf

                @if ($errors->any())
                    <div class="alert-error" role="alert">{{ $errors->first() }}</div>
                @endif

                <div class="login-field">
                    <label for="username">Username</label>
                    <div class="input-icon">
                        <i class="fa-regular fa-user lead"></i>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username" autocomplete="username" autofocus required>
                    </div>
                </div>

                <div class="login-field">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <i class="fa-solid fa-lock lead"></i>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" autocomplete="current-password" required>
                        <button type="button" class="toggle-pass" id="togglePass" aria-label="Tampilkan password">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="login-row">
                    <label class="remember">
                        <input type="checkbox" name="remember" value="1"> Ingat saya
                    </label>
                    <a href="#">Lupa Password?</a>
                </div>

                <button type="submit" class="btn-login">Login <i class="fa-solid fa-right-to-bracket"></i></button>
            </form>

            <div class="login-foot">Kembali ke <a href="{{ route('home') }}">Halaman Utama</a></div>
        </div>

        <p class="login-copy">&copy; {{ date('Y') }} SMKN 4 KOTA BOGOR All rights reserved.</p>
    </main>

    <script>
        const pass = document.getElementById('password');
        const btn = document.getElementById('togglePass');
        btn.addEventListener('click', () => {
            const show = pass.type === 'password';
            pass.type = show ? 'text' : 'password';
            btn.querySelector('i').className = show ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
            btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });
    </script>
</body>
</html>