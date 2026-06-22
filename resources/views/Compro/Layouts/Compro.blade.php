<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="@yield('meta_description', 'Situs resmi Paroki Santo Yoseph Matraman. Informasi jadwal misa, layanan sakramen, serta panduan kegiatan umat Katolik terbaru.')" />
    <title>Paroki Santo Yoseph Matraman</title>
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="@yield('title', 'Paroki Santo Yoseph Matraman')" />
    <meta property="og:description" content="@yield('meta_description', 'Situs resmi Paroki Santo Yoseph Matraman. Informasi jadwal misa, layanan sakramen, serta panduan kegiatan umat Katolik terbaru.')" />
    <meta property="og:image" content="{{ asset('compro_assets/image/hero.jpg') }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:title" content="@yield('title', 'Paroki Santo Yoseph Matraman')" />
    <meta property="twitter:description" content="@yield('meta_description', 'Situs resmi Paroki Santo Yoseph Matraman. Informasi jadwal misa, layanan sakramen, serta panduan kegiatan umat Katolik terbaru.')" />
    <meta property="twitter:image" content="{{ asset('compro_assets/image/hero.jpg') }}" />
    <link rel="canonical" href="https://parokimatraman.or.id/">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link rel="icon" type="image/x-icon" href="{{ asset('compro_assets/image/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('compro_assets/style.css') }}?v=1.2" />
    <link rel="stylesheet" href="{{ asset('compro_assets/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('compro_assets/dark-mode.css') }}?v=1.2" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>/* Anti-FOUC: apply dark class before first paint */
    (function(){if(localStorage.getItem('parokimatraman_dark_mode')==='dark'){document.documentElement.classList.add('dark');}})();
    </script>
    <link rel="alternate" hreflang="id-ID" href="{{ url()->current() }}" />
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}" />
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "CatholicChurch",
      "name": "Paroki Santo Yoseph Matraman",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('compro_assets/image/logo.png') }}",
      "image": "{{ asset('compro_assets/image/hero.jpg') }}",
      "description": "Situs resmi Paroki Santo Yoseph Matraman. Informasi jadwal misa, layanan sakramen, serta panduan kegiatan umat Katolik terbaru.",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "Jl. Matraman Raya No.127",
        "addressLocality": "Jakarta Timur",
        "addressRegion": "DKI Jakarta",
        "postalCode": "13140",
        "addressCountry": "ID"
      }
    }
    </script>
    @yield('styles')
</head>

<body>
    <!-- Loading bar -->
    <div id="page-loader" style="position:fixed;top:0;left:0;width:0;height:3px;background:var(--primary,#b91c1c);z-index:9999;transition:width 0.3s ease,opacity 0.4s ease;opacity:0;"></div>

    @include('Compro.Atomic.Organisms.Header')

    <main>
        @yield('content')
    </main>

    @include('Compro.Atomic.Organisms.Footer')
    @include('Compro.Atomic.Organisms.MobileBottomNav2')

    <script src="{{ asset('compro_assets/js/navbar.js') }}?v=1.1"></script>
    <script src="{{ asset('js/dark-mode.js') }}"></script>
    <script>
    (function () {
        var loader = document.getElementById('page-loader');
        // Show loader on any link click
        document.addEventListener('click', function (e) {
            var a = e.target.closest('a[href]');
            if (!a) return;
            var href = a.getAttribute('href');
            // Skip anchors, external, or JS links
            if (!href || href.startsWith('#') || href.startsWith('javascript') || a.target === '_blank') return;
            var url;
            try { url = new URL(href, location.href); } catch(err) { return; }
            if (url.origin !== location.origin) return;
            // Show loader
            loader.style.opacity = '1';
            loader.style.width = '70%';
        });
        // Complete loader on load
        window.addEventListener('pageshow', function () {
            loader.style.width = '100%';
            setTimeout(function () {
                loader.style.opacity = '0';
                setTimeout(function () { loader.style.width = '0'; }, 400);
            }, 200);
        });
    }());
    </script>
    @yield('scripts')
</body>

</html>
