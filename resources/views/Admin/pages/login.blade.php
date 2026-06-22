<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login — Admin Parokimatraman</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin_assets/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/dark-mode.css') }}" />
    <script>/* Anti-FOUC */
    (function(){if(localStorage.getItem('parokimatraman_dark_mode')==='dark'){document.documentElement.classList.add('dark');}})();
    </script>
</head>

<body>

    <div class="auth-wrap">
        <div class="auth-card">
            <span class="auth-card__logo">Parokimatraman</span>
            <h1 class="auth-card__title">Masuk ke Admin</h1>
            <p class="auth-card__sub">Masukkan username dan password Anda.</p>

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}"
                        autocomplete="username" autofocus
                        class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" />
                    @error('username')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input id="password" type="password" name="password" autocomplete="current-password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" />
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="display:flex;align-items:center;gap:8px;">
                    <input type="checkbox" id="remember" name="remember" />
                    <label for="remember" style="font-size:13px;color:var(--muted);">Ingat saya</label>
                </div>

                <button type="submit" class="btn btn-primary btn-full" style="margin-top:8px;">
                    Masuk
                </button>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/dark-mode.js') }}"></script>
</body>

</html>
