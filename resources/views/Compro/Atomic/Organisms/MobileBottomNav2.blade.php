<nav class="mobile-bottom-nav">
    <a href="{{ route('beranda') }}" class="mobile-bottom-nav__item {{ request()->routeIs('beranda') ? 'is-active' : '' }}">
        <i class="fa fa-home"></i>
        <span>Beranda</span>
    </a>
    <a href="{{ route('artikel.berita') }}" class="mobile-bottom-nav__item {{ request()->routeIs('artikel.berita') ? 'is-active' : '' }}">
        <i class="fa fa-newspaper-o"></i>
        <span>Berita</span>
    </a>
    <a href="{{ route('profil.pastor') }}" class="mobile-bottom-nav__item {{ request()->is('profil*') ? 'is-active' : '' }}">
        <i class="fa fa-user"></i>
        <span>Profil</span>
    </a>
    <button class="mobile-bottom-nav__item" id="mobileBottomMenuToggle" aria-label="Buka Menu">
        <i class="fa fa-bars"></i>
        <span>Menu</span>
    </button>
</nav>
