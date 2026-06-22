@extends('Compro.Layouts.Compro')

@section('title', $sakramen->judul . ' — Paroki Santo Yoseph Matraman')

@section('content')

    {{-- ══ HERO ══════════════════════════════════════════════════════════════ --}}
    <section class="sak-hero">
        <div class="sak-hero__bg">
            @if ($sakramen->hero_image)
                <img src="{{ media_url($sakramen->hero_image, 'assets/sakramen') }}" alt="" aria-hidden="true" class="sak-hero__img" />
            @endif
            <div class="sak-hero__overlay"></div>
            <svg class="sak-hero__cross" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <rect x="44" y="10" width="12" height="80" fill="currentColor"/>
                <rect x="10" y="36" width="80" height="12" fill="currentColor"/>
            </svg>
        </div>
        <div class="sak-hero__content">
            <div class="sak-hero__meta">
                <a href="{{ route('beranda') }}" class="sak-hero__crumb">Beranda</a>
                <span class="sak-hero__sep">/</span>
                <span class="sak-hero__crumb sak-hero__crumb--active">Pelayanan</span>
            </div>
            <h1 class="sak-hero__title">{{ $sakramen->judul }}</h1>
            <p class="sak-hero__sub">{{ $sakramen->accent_text ?? 'Pelayanan Sakramen · Paroki Santo Yoseph Matraman' }}</p>
        </div>
        <div class="sak-hero__scroll-hint"><span></span></div>
    </section>

    {{-- ══ INTRO (deskripsi) ════════════════════════════════════════════════ --}}
    @if ($sakramen->deskripsi)
        <section class="sak-intro-section">
            <div class="sak-wrap">
                <div class="sak-ornament" aria-hidden="true">
                    <span class="sak-ornament__line"></span>
                    <svg class="sak-ornament__icon" viewBox="0 0 24 24" width="14" height="14">
                        <rect x="10.5" y="2" width="3" height="20" fill="currentColor"/>
                        <rect x="2" y="8" width="20" height="3" fill="currentColor"/>
                    </svg>
                    <span class="sak-ornament__line"></span>
                </div>
                <p class="sak-intro-text">{{ $sakramen->deskripsi }}</p>
            </div>
        </section>
    @endif

    {{-- ══ SECTIONS ══════════════════════════════════════════════════════════ --}}
    @foreach ($sakramen->sections ?? [] as $i => $sec)
        <section class="sak-content-section {{ $i % 2 !== 0 ? 'sak-content-section--alt' : '' }}">
            <div class="sak-wrap">
                <div class="sak-content-row">
                    <div class="sak-content-aside">
                        <span class="sak-content-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <h2 class="sak-content-heading">{{ $sec['judul'] ?? ('Bagian ' . ($i + 1)) }}</h2>
                        <div class="sak-content-aside-rule"></div>
                    </div>
                    <div class="sak-content-body">
                        @foreach ($sec['paragraf'] ?? [] as $par)
                            @if ($par)
                                <p class="sak-par">{{ $par }}</p>
                            @endif
                        @endforeach

                        @if (!empty($sec['list']))
                            <ul class="sak-list">
                                @foreach ($sec['list'] as $listItem)
                                    @if ($listItem)
                                        <li>
                                            <span class="sak-list__bullet" aria-hidden="true">✦</span>
                                            <span>{{ $listItem }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    {{-- ══ KONTAK ════════════════════════════════════════════════════════════ --}}
    @if ($sakramen->kontak_nama || $sakramen->kontak_telepon || $sakramen->kontak_email || $sakramen->kontak_catatan)
        <section class="sak-kontak-section">
            <div class="sak-wrap">
                <div class="sak-kontak-inner">
                    <div class="sak-kontak-label">
                        <span class="sak-label-chip">Kontak</span>
                        <p class="sak-kontak-subtitle">Hubungi kami untuk<br>informasi lebih lanjut</p>
                    </div>
                    <div class="sak-kontak-card">
                        @if ($sakramen->kontak_nama)
                            <div class="sak-kontak__name">{{ $sakramen->kontak_nama }}</div>
                        @endif
                        @if ($sakramen->kontak_telepon)
                            <a href="tel:{{ $sakramen->kontak_telepon }}" class="sak-kontak__item">
                                <span class="sak-kontak__item-icon">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.13 9.77a19.79 19.79 0 01-3.07-8.67A2 2 0 012.24 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.09a16 16 0 006 6l.56-.56a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 15.92z"/></svg>
                                </span>
                                <span>{{ $sakramen->kontak_telepon }}</span>
                            </a>
                        @endif
                        @if ($sakramen->kontak_email)
                            <a href="mailto:{{ $sakramen->kontak_email }}" class="sak-kontak__item">
                                <span class="sak-kontak__item-icon">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </span>
                                <span>{{ $sakramen->kontak_email }}</span>
                            </a>
                        @endif
                        @if ($sakramen->kontak_catatan)
                            <p class="sak-kontak__note">{{ $sakramen->kontak_catatan }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ══ UNDUHAN ═══════════════════════════════════════════════════════════ --}}
    @if (!empty($sakramen->unduhan))
        <section class="sak-unduhan-section">
            <div class="sak-wrap">
                <div class="sak-unduhan-header">
                    <span class="sak-label-chip">Unduhan</span>
                </div>
                <div class="sak-unduhan-grid">
                    @foreach ($sakramen->unduhan as $ud)
                        @if (!empty($ud['nama']) || !empty($ud['url']))
                            <a href="{{ $ud['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                                class="sak-unduhan-card">
                                <div class="sak-unduhan-card__icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                                        <polyline points="7 10 12 15 17 10"/>
                                        <line x1="12" y1="15" x2="12" y2="3"/>
                                    </svg>
                                </div>
                                <div class="sak-unduhan-card__body">
                                    <span class="sak-unduhan-card__name">{{ $ud['nama'] ?? 'Unduh File' }}</span>
                                    <span class="sak-unduhan-card__action">Unduh &rarr;</span>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ══ CTA MISA ══════════════════════════════════════════════════════════ --}}
    <section class="sak-cta">
        <div class="sak-wrap">
            <div class="sak-cta__inner">
                <div class="sak-cta__text">
                    <p class="sak-cta__eyebrow">Jadwal Misa</p>
                    <h2 class="sak-cta__title">Hadir &amp; berdoa<br>bersama komunitas</h2>
                </div>
                <a href="{{ route('beranda') }}#jadwal-misa" class="sak-cta__btn">Lihat Jadwal Misa &rarr;</a>
            </div>
        </div>
    </section>

    <style>
        /* ══ WRAP ════════════════════════════════════════════════════════════ */
        .sak-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 48px;
        }

        /* ══ HERO ════════════════════════════════════════════════════════════ */
        .sak-hero {
            position: relative;
            min-height: 58vh;
            display: flex;
            align-items: flex-end;
            padding-bottom: 80px;
            overflow: hidden;
            background: linear-gradient(135deg, #1c0a02 0%, #0a0a0a 65%);
        }

        .sak-hero__bg {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .sak-hero__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            filter: grayscale(25%);
        }

        .sak-hero__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                rgba(0, 0, 0, .92) 0%,
                rgba(0, 0, 0, .55) 55%,
                rgba(0, 0, 0, .22) 100%);
        }

        .sak-hero__cross {
            position: absolute;
            right: 6%;
            top: 50%;
            transform: translateY(-50%);
            width: 260px;
            height: 260px;
            color: rgba(255, 255, 255, .04);
            pointer-events: none;
        }

        .sak-hero__content {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 48px;
        }

        .sak-hero__meta {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .sak-hero__crumb {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .4);
            text-decoration: none;
            transition: color .2s;
        }

        .sak-hero__crumb:hover { color: rgba(255, 255, 255, .75); }
        .sak-hero__crumb--active { color: rgba(255, 255, 255, .6); }
        .sak-hero__sep { color: rgba(255, 255, 255, .2); font-size: 11px; }

        .sak-hero__title {
            font-size: clamp(2.2rem, 5vw, 4rem);
            font-weight: 700;
            color: #fff;
            line-height: 1.1;
            letter-spacing: -.025em;
            margin: 0 0 18px;
        }

        .sak-hero__sub {
            font-size: 14.5px;
            color: rgba(255, 255, 255, .4);
            letter-spacing: .05em;
            margin: 0;
        }

        .sak-hero__scroll-hint {
            position: absolute;
            bottom: 28px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }

        .sak-hero__scroll-hint span {
            display: block;
            width: 1px;
            height: 44px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, .45), transparent);
            margin: 0 auto;
        }

        /* ══ ORNAMENT ════════════════════════════════════════════════════════ */
        .sak-ornament {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .sak-ornament__line {
            flex: 1;
            height: 1px;
            background: rgba(184, 154, 12, 0.25);
        }

        .sak-ornament__icon { color: rgba(184, 154, 12, 0.35); flex-shrink: 0; }

        /* ══ INTRO ════════════════════════════════════════════════════════════ */
        .sak-intro-section {
            padding: 88px 0;
            background: #faf6ee;
        }

        .sak-intro-text {
            font-size: clamp(1rem, 1.4vw, 1.15rem);
            line-height: 1.95;
            color: rgba(42, 24, 14, 0.62);
            text-align: center;
            max-width: 720px;
            margin: 0 auto;
        }

        /* ══ LABEL CHIP ══════════════════════════════════════════════════════ */
        .sak-label-chip {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: rgba(42, 24, 14, 0.38);
            border: 1px solid rgba(42, 24, 14, 0.12);
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 16px;
        }

        /* ══ CONTENT SECTIONS ════════════════════════════════════════════════ */
        .sak-content-section {
            padding: 88px 0;
            background: #f0e8d8;
            border-top: 1px solid rgba(42, 24, 14, 0.08);
        }

        .sak-content-section--alt { background: #faf6ee; }

        .sak-content-row {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 72px;
            align-items: flex-start;
        }

        .sak-content-aside {
            position: sticky;
            top: 96px;
        }

        .sak-content-num {
            display: block;
            font-size: 5.5rem;
            font-weight: 800;
            color: rgba(42, 24, 14, 0.05);
            font-family: 'Cinzel', Georgia, serif;
            line-height: 1;
            letter-spacing: -.04em;
            margin-bottom: 14px;
        }

        .sak-content-heading {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2a180e;
            font-family: 'Cinzel', Georgia, serif;
            line-height: 1.35;
            margin: 0 0 20px;
        }

        .sak-content-aside-rule {
            width: 28px;
            height: 2px;
            background: rgba(184, 154, 12, 0.35);
        }

        .sak-par {
            font-family: var(--font-primary);
            font-size: 1.2rem;
            line-height: 1.88;
            color: rgba(42, 24, 14, 0.62);
            margin: 0 0 18px;
        }

        .sak-par:last-of-type { margin-bottom: 0; }

        .sak-list {
            list-style: none;
            padding: 0;
            margin: 22px 0 0;
            display: flex;
            flex-direction: column;
        }

        .sak-list li {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            font-family: var(--font-primary);
            font-size: 1.1rem;
            line-height: 1.72;
            color: rgba(42, 24, 14, 0.62);
            padding: 11px 0;
            border-bottom: 1px solid rgba(42, 24, 14, 0.08);
        }

        .sak-list li:last-child { border-bottom: none; }

        .sak-list__bullet {
            font-size: 7px;
            color: rgba(42, 24, 14, 0.25);
            flex-shrink: 0;
            margin-top: 8px;
        }

        /* ══ KONTAK SECTION ══════════════════════════════════════════════════ */
        .sak-kontak-section {
            padding: 88px 0;
            background: #f0e8d8;
            border-top: 1px solid rgba(42, 24, 14, 0.08);
        }

        .sak-kontak-inner {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 72px;
            align-items: flex-start;
        }

        .sak-kontak-subtitle {
            font-size: 13px;
            color: rgba(42, 24, 14, 0.40);
            line-height: 1.65;
            margin: 0;
        }

        .sak-kontak-card {
            background: rgba(42, 24, 14, 0.025);
            border: 1px solid rgba(42, 24, 14, 0.10);
            border-radius: 16px;
            padding: 28px 32px;
            max-width: 480px;
        }

        .sak-kontak__name {
            font-size: 1.05rem;
            font-weight: 600;
            color: #2a180e;
            font-family: 'Cinzel', Georgia, serif;
            margin-bottom: 20px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(42, 24, 14, 0.08);
        }

        .sak-kontak__item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            text-decoration: none;
            border-bottom: 1px solid rgba(42, 24, 14, 0.06);
            color: rgba(42, 24, 14, 0.62);
            font-size: 0.9rem;
            transition: color .2s;
        }

        .sak-kontak__item:last-of-type { border-bottom: none; }
        .sak-kontak__item:hover { color: #2a180e; }

        .sak-kontak__item-icon {
            color: rgba(42, 24, 14, 0.28);
            display: flex;
            align-items: center;
            flex-shrink: 0;
            transition: color .2s;
        }

        .sak-kontak__item:hover .sak-kontak__item-icon { color: rgba(42, 24, 14, 0.55); }

        .sak-kontak__note {
            font-size: 0.82rem;
            line-height: 1.65;
            color: rgba(42, 24, 14, 0.40);
            margin: 18px 0 0;
            padding-top: 16px;
            border-top: 1px solid rgba(42, 24, 14, 0.08);
        }

        /* ══ UNDUHAN ══════════════════════════════════════════════════════════ */
        .sak-unduhan-section {
            padding: 88px 0;
            background: #faf6ee;
            border-top: 1px solid rgba(42, 24, 14, 0.08);
        }

        .sak-unduhan-header { margin-bottom: 28px; }

        .sak-unduhan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
            gap: 14px;
        }

        .sak-unduhan-card {
            display: flex;
            align-items: center;
            gap: 16px;
            background: rgba(42, 24, 14, 0.025);
            border: 1px solid rgba(42, 24, 14, 0.10);
            border-radius: 12px;
            padding: 18px 22px;
            text-decoration: none;
            transition: background .2s, border-color .2s, transform .2s;
        }

        .sak-unduhan-card:hover {
            background: rgba(42, 24, 14, 0.05);
            border-color: rgba(184, 154, 12, 0.30);
            transform: translateY(-2px);
        }

        .sak-unduhan-card__icon {
            width: 40px;
            height: 40px;
            background: rgba(42, 24, 14, 0.04);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(42, 24, 14, 0.35);
            flex-shrink: 0;
        }

        .sak-unduhan-card__body {
            display: flex;
            flex-direction: column;
            gap: 4px;
            min-width: 0;
        }

        .sak-unduhan-card__name {
            font-size: 0.9rem;
            font-weight: 500;
            color: rgba(42, 24, 14, 0.80);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sak-unduhan-card__action {
            font-size: 11px;
            color: rgba(42, 24, 14, 0.35);
        }

        /* ══ CTA ══════════════════════════════════════════════════════════════ */
        .sak-cta {
            padding: 88px 0;
            background: #f0e8d8;
            border-top: 1px solid rgba(42, 24, 14, 0.08);
        }

        .sak-cta__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            padding: 52px 60px;
            background: rgba(42, 24, 14, 0.03);
            border: 1px solid rgba(184, 154, 12, 0.20);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
        }

        .sak-cta__inner::before {
            content: '';
            position: absolute;
            right: -40px;
            top: -40px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184, 154, 12, 0.06) 0%, transparent 70%);
            pointer-events: none;
        }

        .sak-cta__eyebrow {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: rgba(42, 24, 14, 0.40);
            margin: 0 0 12px;
        }

        .sak-cta__title {
            font-size: clamp(1.4rem, 2.5vw, 2.1rem);
            font-weight: 700;
            color: #2a180e;
            font-family: 'Cinzel', Georgia, serif;
            line-height: 1.2;
            letter-spacing: -.025em;
            margin: 0;
        }

        .sak-cta__btn {
            display: inline-block;
            white-space: nowrap;
            padding: 14px 28px;
            border: 1px solid rgba(109, 43, 53, 0.35);
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            color: #6d2b35;
            text-decoration: none;
            transition: background .2s, border-color .2s;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }

        .sak-cta__btn:hover {
            background: rgba(109, 43, 53, 0.10);
            border-color: rgba(109, 43, 53, 0.55);
        }

        /* ══ RESPONSIVE ══════════════════════════════════════════════════════ */
        @media (max-width: 900px) {
            .sak-wrap { padding: 0 28px; }

            .sak-content-row,
            .sak-kontak-inner {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .sak-content-aside { position: static; }
            .sak-content-num { font-size: 3.5rem; }

            .sak-cta__inner {
                flex-direction: column;
                align-items: flex-start;
                padding: 36px 32px;
            }
        }

        @media (max-width: 600px) {
            .sak-wrap { padding: 0 20px; }

            .sak-hero { min-height: 50vh; padding-bottom: 56px; }
            .sak-hero__content { padding: 0 20px; }

            .sak-intro-section,
            .sak-content-section,
            .sak-kontak-section,
            .sak-unduhan-section,
            .sak-cta { padding: 56px 0; }

            .sak-kontak-card { max-width: 100%; }

            .sak-cta__inner { padding: 28px 24px; }
        }
    </style>

@endsection
