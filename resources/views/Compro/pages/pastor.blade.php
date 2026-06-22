@extends('Compro.Layouts.Compro')

@section('title', 'Pastor — Paroki Santo Yoseph Matraman')

@section('content')
    <!-- Hero -->
    <section class="page-hero">
        @if ($page && $page->hero_image)
            <img src="{{ media_url($page->hero_image, 'assets/pastor') }}" alt="" class="page-hero__bg" aria-hidden="true" />
        @else
            <div class="page-hero__bg"></div>
        @endif
        <div class="page-hero__content">
            <div class="page-hero__left">
                <span class="page-hero__eyebrow">Profil Paroki</span>
                <h1 class="page-hero__title">Pastor</h1>
            </div>
            <div class="page-hero__right">
                <span class="page-hero__accent">{{ ($page && $page->accent_text) ? $page->accent_text : 'Para gembala yang telah melayani umat paroki' }}</span>
            </div>
        </div>
    </section>

    {{-- Daftar Pastor --}}
    @if ($pastors->isNotEmpty())
        <section class="page-section page-section--alt">
            <div class="page-inner">
                <div class="page-2col">
                    <div class="page-2col__label">
                        <span class="page-label">Para Pastor</span>
                    </div>
                    <div>
                        <div class="pastor-grid">
                            @foreach ($pastors as $p)
                                <div class="pastor-card">
                                    <div class="pastor-card__img-wrap">
                                        @if ($p->foto)
                                            <img src="{{ media_url($p->foto, 'assets/pastor') }}"
                                                alt="{{ $p->nama }}" class="pastor-card__img" />
                                        @else
                                            <div class="pastor-card__img pastor-card__img--placeholder"><svg
                                                    viewBox="0 0 60 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="60" height="80" fill="rgba(255,255,255,0.04)" />
                                                    <circle cx="30" cy="26" r="12"
                                                        fill="rgba(255,255,255,0.12)" />
                                                    <ellipse cx="30" cy="60" rx="20" ry="14"
                                                        fill="rgba(255,255,255,0.08)" />
                                                </svg></div>
                                        @endif
                                    </div>
                                    <div class="pastor-card__body">
                                        <span class="pastor-card__role">{{ $p->jabatan }}</span>
                                        <div class="pastor-card__name">
                                            {{ $p->nama }}{{ $p->ordo ? ', ' . $p->ordo : '' }}</div>
                                        @if ($p->periode_mulai)
                                            <div class="pastor-card__period">
                                                {{ $p->periode_mulai }}{{ $p->periode_selesai ? ' — ' . $p->periode_selesai : ' — Sekarang' }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($pastors->isEmpty())
        <section class="page-section">
            <div class="page-inner" style="text-align:center;padding:80px 0;">
                <p style="color:rgba(255,255,255,0.5);font-size:1.1rem;">Data pastor belum tersedia.</p>
            </div>
        </section>
    @endif

    <style>
        /* ── Pastor grid ─────────────────────────── */
        .pastor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 24px;
        }

        .pastor-card {
            background: #fffdf7;
            border: 1px solid rgba(42, 24, 14, 0.10);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
        }

        .pastor-card:hover {
            transform: translateY(-4px);
            border-color: rgba(184, 154, 12, 0.30);
            box-shadow: 0 6px 20px rgba(42, 24, 14, 0.10);
        }

        .pastor-card__img-wrap {
            aspect-ratio: 3 / 4;
            overflow: hidden;
        }

        .pastor-card__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .pastor-card__body {
            padding: 16px;
        }

        .pastor-card__role {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(42, 24, 14, 0.40);
            margin-bottom: 6px;
        }

        .pastor-card__name {
            font-size: 1rem;
            font-weight: 600;
            color: #2a180e;
            font-family: 'Cinzel', Georgia, serif;
            line-height: 1.4;
            margin-bottom: 4px;
        }

        .pastor-card__period {
            font-size: 1rem;
            color: rgba(42, 24, 14, 0.38);
        }

        .pastor-card__img--placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(42, 24, 14, 0.04);
        }

        .pastor-card__img--placeholder svg {
            width: 100%;
            height: 100%;
        }
    </style>
@endsection
