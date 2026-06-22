@extends('Compro.Layouts.Compro')

@section('title', 'Renungan — Paroki Santo Yoseph Matraman')

@section('content')
    <!-- Hero -->
    <section class="page-hero">
        @if ($renunganPage->hero_image)
            <img src="{{ media_url($renunganPage->hero_image, 'assets/renungan') }}" alt="" class="page-hero__bg" aria-hidden="true" />
        @else
            <div class="page-hero__bg"></div>
        @endif
        <div class="page-hero__content">
            <div class="page-hero__left">
                <span class="page-hero__eyebrow">Refleksi &amp; Rohani</span>
                <h1 class="page-hero__title">Renungan</h1>
            </div>
            <div class="page-hero__right">
                <span class="page-hero__accent">{{ $renunganPage->accent_text ?? 'Sabda yang menghidupkan jiwa dan iman kita' }}</span>
            </div>
        </div>
    </section>

    @if ($renungans->isEmpty())
        <section class="page-section">
            <div class="page-inner" style="text-align:center;padding:80px 0;color:#888">
                <p>Belum ada renungan yang dipublikasikan.</p>
            </div>
        </section>
    @else
        {{-- Featured Renungan --}}
        @if ($featured)
            <section class="renungan-featured-section">
                <div class="page-inner">
                    <div class="renungan-featured">
                        <div class="renungan-featured__ornament" aria-hidden="true">✦</div>

                        @if ($featured->tema)
                            <span class="renungan-tema-tag">{{ $featured->tema }}</span>
                        @endif

                        @if ($featured->kutipan)
                            <blockquote class="renungan-featured__quote">
                                {{ $featured->kutipan }}
                            </blockquote>
                        @endif

                        <h2 class="renungan-featured__title">{{ $featured->judul }}</h2>

                        <div class="renungan-featured__meta">
                            <span class="renungan-date">
                                {{ $featured->published_at ? $featured->published_at->translatedFormat('d F Y') : '' }}
                            </span>
                            @if ($featured->penulis)
                                <span class="renungan-author-badge">{{ $featured->penulis }}</span>
                            @endif
                        </div>

                        <a href="{{ route('artikel.renungan.show', $featured->slug) }}" class="renungan-featured__cta">
                            Baca Renungan Ini ↓
                        </a>

                        @if ($featured->video)
                            <div class="renungan-featured__media-wrap">
                                <video class="renungan-featured__video" controls preload="metadata"
                                    poster="{{ $featured->gambar ? media_url($featured->gambar, 'compro_assets/image/renungan') : '' }}">
                                    <source src="{{ media_url($featured->video, 'compro_assets/media/renungan') }}">
                                </video>
                            </div>
                        @elseif ($featured->gambar)
                            <div class="renungan-featured__img-wrap">
                                <img src="{{ media_url($featured->gambar, 'compro_assets/image/renungan') }}"
                                    alt="{{ $featured->judul }}" class="renungan-featured__img" />
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        {{-- Renungan List --}}
        @if ($others->isNotEmpty())
            <section class="page-section page-section--alt">
                <div class="page-inner">
                    <div class="renungan-list-header">
                        <span class="page-label">Renungan Lainnya</span>
                    </div>
                    <div class="renungan-list">
                        @foreach ($others as $item)
                            <a href="{{ route('artikel.renungan.show', $item->slug) }}" class="renungan-row">
                                <div class="renungan-row__left">
                                    <div class="renungan-row__date">
                                        <span class="renungan-row__day">
                                            {{ $item->published_at ? $item->published_at->format('d') : '—' }}
                                        </span>
                                        <span class="renungan-row__month">
                                            {{ $item->published_at ? $item->published_at->translatedFormat('M Y') : '' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="renungan-row__divider" aria-hidden="true"></div>
                                <div class="renungan-row__body">
                                    @if ($item->tema)
                                        <span class="renungan-tema-tag renungan-tema-tag--sm">{{ $item->tema }}</span>
                                    @endif
                                    <h3 class="renungan-row__title">{{ $item->judul }}</h3>
                                    @if ($item->kutipan)
                                        <p class="renungan-row__quote">{{ Str::limit($item->kutipan, 100) }}</p>
                                    @endif
                                    @if ($item->penulis)
                                        <div class="renungan-row__author">Oleh: {{ $item->penulis }}</div>
                                    @endif
                                </div>
                                @if ($item->gambar)
                                    <div class="renungan-row__thumb">
                                        <img src="{{ media_url($item->gambar, 'compro_assets/image/renungan') }}"
                                            alt="" loading="lazy" />
                                    </div>
                                @elseif ($item->video)
                                    <div class="renungan-row__thumb renungan-row__thumb--video">
                                        <video muted preload="metadata" playsinline
                                            class="renungan-row__thumb-vid"
                                            src="{{ media_url($item->video, 'compro_assets/media/renungan') }}">
                                        </video>
                                        <span class="renungan-row__thumb-play" aria-hidden="true">▶</span>
                                    </div>
                                @endif
                                <div class="renungan-row__arrow" aria-hidden="true">→</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    @endif
@endsection

@section('styles')
<style>
    .renungan-featured__media-wrap {
        margin-top: 28px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
    }
    .renungan-featured__video {
        width: 100%;
        display: block;
        max-height: 420px;
        background: #000;
        border-radius: 12px;
    }

    .renungan-row__thumb {
        flex-shrink: 0;
        width: 72px;
        height: 72px;
        border-radius: 6px;
        overflow: hidden;
        margin-left: auto;
        align-self: center;
    }
    .renungan-row__thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
    }
    .renungan-row__thumb--video {
        position: relative;
        background: #111;
    }
    .renungan-row__thumb-vid {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
        border-radius: 6px;
    }
    .renungan-row__thumb-play {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #fff;
        background: rgba(0,0,0,0.35);
        border-radius: 6px;
        pointer-events: none;
    }
</style>

@section('scripts')
<script>
document.querySelectorAll('.renungan-row__thumb-vid').forEach(function(v) {
    v.addEventListener('loadedmetadata', function() {
        v.currentTime = 0.001;
    });
});
</script>
@endsection
@endsection
