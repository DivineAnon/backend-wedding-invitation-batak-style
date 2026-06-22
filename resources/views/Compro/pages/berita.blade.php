@extends('Compro.Layouts.Compro')

@section('title', 'Berita — Paroki Mataram')

@section('content')
    <!-- Hero -->
    <section class="page-hero">
        @if ($beritaPage && $beritaPage->hero_image)
            <img src="{{ media_url($beritaPage->hero_image, 'assets/berita') }}" alt="" class="page-hero__bg" aria-hidden="true" />
        @else
            <div class="page-hero__bg"></div>
        @endif
        <div class="page-hero__content">
            <div class="page-hero__left">
                <span class="page-hero__eyebrow">Artikel &amp; Renungan</span>
                <h1 class="page-hero__title">Berita</h1>
            </div>
            <div class="page-hero__right">
                <span class="page-hero__accent">{{ ($beritaPage && $beritaPage->accent_text) ? $beritaPage->accent_text : 'Warta terkini dari Paroki Santo Yoseph Matraman' }}</span>
            </div>
        </div>
    </section>

    <!-- Filter bar -->
    @if ($kategoris->isNotEmpty())
        <section class="berita-filter-section">
            <div class="page-inner">
                <div class="berita-filter">
                    <a href="{{ route('artikel.berita') }}"
                        class="berita-filter__btn {{ !request('kategori') ? 'berita-filter__btn--active' : '' }}">
                        Semua
                    </a>
                    @foreach ($kategoris as $kat)
                        <a href="{{ route('artikel.berita', ['kategori' => $kat->slug]) }}"
                            class="berita-filter__btn {{ request('kategori') === $kat->slug ? 'berita-filter__btn--active' : '' }}">
                            {{ $kat->nama }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($featured)
        <!-- Featured article -->
        <section class="page-section">
            <div class="page-inner">
                <div class="berita-featured">
                    <div class="berita-featured__img-wrap">
                        @if ($featured->cover)
                            <img src="{{ media_url($featured->cover, 'assets/berita') }}"
                                alt="{{ $featured->judul }}" class="berita-featured__img" />
                        @else
                            <img src="{{ asset('compro_assets/image/hero.jpg') }}" alt="{{ $featured->judul }}"
                                class="berita-featured__img" />
                        @endif
                    </div>
                    <div class="berita-featured__body">
                        <div class="berita-featured__meta">
                            <span class="berita-tag">{{ $featured->kategori->nama ?? '' }}</span>
                            <span class="berita-date">
                                {{ $featured->published_at ? $featured->published_at->translatedFormat('d F Y') : '' }}
                            </span>
                        </div>
                        <h2 class="berita-featured__title">{{ $featured->judul }}</h2>
                        @if ($featured->ringkasan)
                            <p class="berita-featured__excerpt">{{ $featured->ringkasan }}</p>
                        @endif
                        <a href="{{ route('artikel.berita.show', $featured->slug) }}" class="berita-featured__link">
                            Baca selengkapnya &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($others->isNotEmpty())
        <!-- Article grid -->
        <section class="page-section page-section--alt">
            <div class="page-inner">
                <div class="berita-grid-header">
                    <span class="page-label">Semua Artikel</span>
                </div>
                <div class="berita-grid">
                    @foreach ($others as $item)
                        <article class="berita-card">
                            <a href="{{ route('artikel.berita.show', $item->slug) }}" class="berita-card__link">
                                <div class="berita-card__img-wrap">
                                    @if ($item->cover)
                                        <img src="{{ media_url($item->cover, 'assets/berita') }}"
                                            alt="{{ $item->judul }}" class="berita-card__img" />
                                    @else
                                        <img src="{{ asset('compro_assets/image/hero.jpg') }}" alt=""
                                            class="berita-card__img" />
                                    @endif
                                </div>
                                <div class="berita-card__body">
                                    <div class="berita-card__meta">
                                        <span class="berita-tag">{{ $item->kategori->nama ?? '' }}</span>
                                        <span class="berita-date">
                                            {{ $item->published_at ? $item->published_at->translatedFormat('d M Y') : '' }}
                                        </span>
                                    </div>
                                    <h3 class="berita-card__title">{{ $item->judul }}</h3>
                                    @if ($item->ringkasan)
                                        <p class="berita-card__excerpt">{{ Str::limit($item->ringkasan, 100) }}</p>
                                    @endif
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($beritas->isEmpty())
        <section class="page-section">
            <div class="page-inner" style="text-align:center;padding:80px 0;color:#888">
                <p>Belum ada berita yang dipublikasikan.</p>
            </div>
        </section>
    @endif
@endsection
