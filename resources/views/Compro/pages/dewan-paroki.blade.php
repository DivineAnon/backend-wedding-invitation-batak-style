@extends('Compro.Layouts.Compro')

@section('title', 'Dewan Paroki — Paroki Santo Yoseph Matraman')

@section('content')
    <!-- Hero -->
    <section class="page-hero">
        @if ($page && $page->hero_image)
            <img src="{{ media_url($page->hero_image, 'assets/dewan-paroki') }}" alt="" class="page-hero__bg" aria-hidden="true" />
        @else
            <div class="page-hero__bg"></div>
        @endif
        <div class="page-hero__content">
            <div class="page-hero__left">
                <span class="page-hero__eyebrow">Profil Paroki</span>
                <h1 class="page-hero__title">Dewan Paroki</h1>
            </div>
            <div class="page-hero__right">
                <span class="page-hero__accent">{{ ($page && $page->accent_text) ? $page->accent_text : 'Bersama melayani umat paroki' }}</span>
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="page-inner">
            @if ($anggota->isEmpty())
                <div style="text-align:center;padding:80px 0;">
                    <p style="color:rgba(255,255,255,0.5);font-size:1.1rem;">Data dewan paroki belum tersedia.</p>
                </div>
            @else
                <div class="dewan-grid">
                    @foreach ($anggota as $a)
                        <div class="dewan-card">
                            <div class="dewan-card__img-wrap">
                                @if ($a->foto)
                                    <img src="{{ media_url($a->foto, 'assets/dewan-paroki') }}"
                                        alt="{{ $a->nama }}" class="dewan-card__img" />
                                @else
                                    <div class="dewan-card__img dewan-card__img--placeholder">
                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5">
                                            <circle cx="12" cy="8" r="4" />
                                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="dewan-card__body">
                                <span class="dewan-card__jabatan">{{ $a->jabatan }}</span>
                                <div class="dewan-card__nama">{{ $a->nama }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <style>
        .dewan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 28px;
        }

        .dewan-card {
            background: #fffdf7;
            border: 1px solid rgba(42, 24, 14, 0.10);
            border-radius: 14px;
            overflow: hidden;
            text-align: center;
            transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
        }

        .dewan-card:hover {
            transform: translateY(-4px);
            border-color: rgba(184, 154, 12, 0.30);
            box-shadow: 0 6px 20px rgba(42, 24, 14, 0.10);
        }

        .dewan-card__img-wrap {
            aspect-ratio: 1 / 1;
            overflow: hidden;
        }

        .dewan-card__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .dewan-card__img--placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(42, 24, 14, 0.05);
            color: rgba(42, 24, 14, 0.20);
        }

        .dewan-card__body {
            padding: 16px 12px 18px;
        }

        .dewan-card__jabatan {
            display: block;
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(42, 24, 14, 0.38);
            margin-bottom: 6px;
        }

        .dewan-card__nama {
            font-size: 0.88rem;
            font-weight: 600;
            color: #2a180e;
            font-family: 'Cinzel', Georgia, serif;
            line-height: 1.4;
        }

        @media (max-width: 480px) {
            .dewan-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }
    </style>
@endsection
