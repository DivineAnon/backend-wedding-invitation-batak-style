<div class="breadcrumb-bar" role="banner">
    <a href="{{ route('beranda') }}" class="breadcrumb-bar__logo-wrap" aria-label="Beranda">
        <img src="{{ asset('compro_assets/image/logo.png') }}" alt="Logo Paroki Matraman" class="breadcrumb-bar__logo" height="30">
    </a>
    <button id="menuToggle" class="breadcrumb-bar__toggle" aria-label="Buka menu">&#9776;</button>
    <nav aria-label="Navigasi halaman">        @php
            $segments = request()->segments();
            $labels = [
                'profil'       => 'Profil',
                'sejarah'      => 'Sejarah',
                'visi-misi'    => 'Visi &amp; Misi',
                'peta-paroki'  => 'Peta Paroki',
                'pastor'       => 'Pastor',
                'dewan-paroki' => 'Dewan Paroki',
                'artikel'      => 'Artikel',
                'berita'       => 'Berita',
                'renungan'     => 'Renungan',
                'pengumuman'   => 'Pengumuman',
                'pelayanan'    => 'Pelayanan',
                'sakramen'     => 'Sakramen',
                'intensi-misa' => 'Intensi Misa',
                'unduhan'      => 'Unduhan',
                'kontak'       => 'Kontak',
            ];
            // Segments that are grouping-only and have no page
            $noLink = ['profil', 'artikel', 'pelayanan', 'sakramen'];
        @endphp
        <ol class="breadcrumb-bar__list" id="breadcrumb-list">
            <li class="breadcrumb-bar__item">
                <a href="{{ route('beranda') }}" class="breadcrumb-bar__link">Beranda</a>
            </li>
            @foreach ($segments as $i => $seg)
                @php $label = $labels[$seg] ?? ucfirst(str_replace('-', ' ', $seg)); @endphp
                <li class="breadcrumb-bar__sep" aria-hidden="true">/</li>
                @if ($i === count($segments) - 1 || in_array($seg, $noLink))
                    <li class="breadcrumb-bar__item breadcrumb-bar__item--current" @if($i === count($segments) - 1) aria-current="page" @endif>{{ $label }}</li>
                @else
                    @php $url = '/' . implode('/', array_slice($segments, 0, $i + 1)); @endphp
                    <li class="breadcrumb-bar__item">
                        <a href="{{ $url }}" class="breadcrumb-bar__link">{{ $label }}</a>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
    {{-- Dark mode toggle --}}
    <button class="dark-toggle" id="darkToggle" aria-label="Aktifkan mode gelap" title="Mode Gelap">
        <span class="dark-toggle__moon" aria-hidden="true">&#9790;</span>
        <span class="dark-toggle__sun"  aria-hidden="true" style="display:none">&#9728;</span>
    </button>
</div>
<script>
(function () {
    var labelMap = {
        'profil': 'Profil', 'sejarah': 'Sejarah', 'visi-misi': 'Visi & Misi',
        'peta-paroki': 'Peta Paroki', 'pastor': 'Pastor', 'dewan-paroki': 'Dewan Paroki',
        'artikel': 'Artikel', 'berita': 'Berita', 'renungan': 'Renungan',
        'pengumuman': 'Pengumuman', 'pelayanan': 'Pelayanan',
        'intensi-misa': 'Intensi Misa', 'unduhan': 'Unduhan', 'kontak': 'Kontak',
    };
    // Group segments with no standalone page — rendered as plain text
    var noLink = { 'profil': true, 'artikel': true, 'pelayanan': true, 'sakramen': true };
    function render() {
        var list = document.getElementById('breadcrumb-list');
        if (!list) return;
        var segs = location.pathname.split('/').filter(Boolean);
        var html = '<li class="breadcrumb-bar__item"><a href="/" class="breadcrumb-bar__link">Beranda</a></li>';
        segs.forEach(function (seg, i) {
            var lbl = labelMap[seg] || seg.replace(/-/g, ' ').replace(/\b\w/g, function (c) { return c.toUpperCase(); });
            var url = '/' + segs.slice(0, i + 1).join('/');
            html += '<li class="breadcrumb-bar__sep" aria-hidden="true">/</li>';
            if (i === segs.length - 1 || noLink[seg]) {
                var cur = i === segs.length - 1 ? ' aria-current="page"' : '';
                html += '<li class="breadcrumb-bar__item breadcrumb-bar__item--current"' + cur + '>' + lbl + '</li>';
            } else {
                html += '<li class="breadcrumb-bar__item"><a href="' + url + '" class="breadcrumb-bar__link">' + lbl + '</a></li>';
            }
        });
        list.innerHTML = html;
    }
    document.addEventListener('pjax:complete', render);
    window.addEventListener('popstate', render);
    render();
}());
</script>

<!-- Offcanvas -->
<div class="offcanvas" id="offcanvas">
    <div class="offcanvas__backdrop" id="offcanvasBackdrop"></div>
    <div class="offcanvas__panel">
        <button class="offcanvas__close" id="offcanvasClose" aria-label="Tutup menu">
            ✕
        </button>
        <div class="offcanvas__brand">
            <a href="{{ route('beranda') }}">
                <img src="{{ asset('compro_assets/image/logo.png') }}" alt="Logo Paroki Matraman" class="offcanvas__logo" height="92">
            </a>
        </div>
        <nav class="offcanvas__menu">
            <ul>
                <li><a href="{{ route('beranda') }}">Beranda</a></li>
                <li class="offcanvas__has-dropdown">
                    <button class="offcanvas__acc-toggle" aria-expanded="false">
                        Profil <span class="offcanvas__acc-arrow">↓</span>
                    </button>
                    <ul class="offcanvas__submenu">
                        <li><a href="{{ route('profil.sejarah') }}">Sejarah</a></li>
                        <li><a href="{{ route('profil.visi-misi') }}">Visi &amp; Misi</a></li>
                        <li><a href="{{ route('profil.peta-paroki') }}">Peta Paroki</a></li>
                        <li><a href="{{ route('profil.pastor') }}">Pastor</a></li>
                        <li><a href="{{ route('profil.dewan-paroki') }}">Dewan Paroki</a></li>
                    </ul>
                </li>
                <li class="offcanvas__has-dropdown">
                    <button class="offcanvas__acc-toggle" aria-expanded="false">
                        Artikel <span class="offcanvas__acc-arrow">↓</span>
                    </button>
                    <ul class="offcanvas__submenu">
                        <li><a href="{{ route('artikel.berita') }}">Berita</a></li>
                        <li><a href="{{ route('artikel.renungan') }}">Renungan</a></li>
                        <li><a href="{{ route('artikel.pengumuman') }}">Pengumuman</a></li>
                    </ul>
                </li>
                <li class="offcanvas__has-dropdown">
                    <button class="offcanvas__acc-toggle" aria-expanded="false">
                        Pelayanan <span class="offcanvas__acc-arrow">↓</span>
                    </button>
                    <ul class="offcanvas__submenu">
                        <li><a href="{{ route('pelayanan.sakramen', 'sakramen-baptis') }}">Sakramen Baptis</a></li>
                        <li><a href="{{ route('pelayanan.sakramen', 'komuni-pertama') }}">Komuni Pertama</a></li>
                        <li><a href="{{ route('pelayanan.sakramen', 'sakramen-krisma') }}">Sakramen Krisma</a></li>
                        <li><a href="{{ route('pelayanan.sakramen', 'sakramen-rekonsiliasi') }}">Sakramen Rekonsiliasi</a></li>
                        <li><a href="{{ route('pelayanan.sakramen', 'sakramen-pengurapan') }}">Sakramen Pengurapan</a></li>
                        <li><a href="{{ route('pelayanan.sakramen', 'sakramen-perkawinan') }}">Sakramen Perkawinan</a></li>
                        <li><a href="{{ route('pelayanan.sakramen', 'sakramen-imamat') }}">Sakramen Imamat</a></li>
                        <li><a href="{{ route('pelayanan.intensi-misa') }}">Intensi Misa</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('unduhan') }}">Unduhan</a></li>
                <li><a href="{{ route('kontak') }}">Kontak</a></li>
            </ul>
        </nav>
    </div>
</div>
