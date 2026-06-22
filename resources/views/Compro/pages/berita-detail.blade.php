@extends('Compro.Layouts.Compro')

@section('title', $berita->judul . ' — Paroki Mataram')

@section('styles')
<style>
/* ── Custom Video Player (vp) ─────────────────────────────────── */
.berita-media-video-wrapper{aspect-ratio:16/9;background:#000;border-radius:8px;overflow:hidden;padding:0}
.vp{position:relative;width:100%;height:100%;background:#000;display:flex;align-items:stretch;overflow:hidden;user-select:none;-webkit-user-select:none}
.vp__video{width:100%;height:100%;display:block;object-fit:contain;background:#000}

/* Big play overlay */
.vp__overlay-play{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.35);border:none;cursor:pointer;transition:background .2s ease,opacity .2s ease;z-index:3;padding:0}
.vp__overlay-play svg{width:72px;height:72px;color:var(--ivory,#faf6ee);filter:drop-shadow(0 2px 8px rgba(0,0,0,.5));background:var(--gold,#b89a0c);border-radius:50%;padding:16px;transition:transform .18s ease,background .18s ease}
.vp__overlay-play:hover svg{background:var(--burgundy,#6d2b35);transform:scale(1.08)}
.vp__overlay-play.is-hidden{opacity:0;pointer-events:none}

/* Controls */
.vp__controls{position:absolute;bottom:0;left:0;right:0;padding:0 0 4px;background:linear-gradient(to top,rgba(0,0,0,.75) 0%,transparent 100%);transform:translateY(100%);transition:transform .22s ease,opacity .22s ease;opacity:0;z-index:4}
.vp:hover .vp__controls,.vp.is-paused .vp__controls,.vp.is-loading .vp__controls{transform:translateY(0);opacity:1}

/* Progress */
.vp__progress-wrap{position:relative;width:100%;height:18px;display:flex;align-items:center;cursor:pointer;padding:0 12px}
.vp__progress-bg,.vp__progress-buf,.vp__progress-fill{position:absolute;left:12px;right:12px;height:3px;border-radius:3px;pointer-events:none;transition:height .12s ease}
.vp__progress-wrap:hover .vp__progress-bg,.vp__progress-wrap:hover .vp__progress-buf,.vp__progress-wrap:hover .vp__progress-fill{height:5px}
.vp__progress-bg{background:rgba(255,255,255,.2)}
.vp__progress-buf{background:rgba(255,255,255,.35);width:0%;right:auto}
.vp__progress-fill{background:var(--gold,#b89a0c);width:0%;right:auto}
.vp__seek{position:absolute;left:12px;right:12px;width:calc(100% - 24px);height:18px;opacity:0;cursor:pointer;margin:0;padding:0;appearance:none;-webkit-appearance:none;background:transparent}

/* Bar */
.vp__bar{display:flex;align-items:center;justify-content:space-between;padding:0 8px 4px;gap:6px}
.vp__bar-left,.vp__bar-right{display:flex;align-items:center;gap:4px}
.vp__btn{background:none;border:none;cursor:pointer;color:rgba(255,255,255,.9);display:flex;align-items:center;justify-content:center;padding:5px;border-radius:4px;transition:color .15s,background .15s;flex-shrink:0;line-height:1}
.vp__btn:hover{color:var(--gold,#b89a0c);background:rgba(255,255,255,.08)}
.vp__icon{width:20px;height:20px;display:block;pointer-events:none}

/* Icon toggles */
.vp__icon--pause,.vp__icon--muted,.vp__icon--compress{display:none}
.vp.is-playing .vp__icon--play{display:none}
.vp.is-playing .vp__icon--pause{display:block}
.vp.is-muted .vp__icon--vol{display:none}
.vp.is-muted .vp__icon--muted{display:block}
.vp.is-fullscreen .vp__icon--expand{display:none}
.vp.is-fullscreen .vp__icon--compress{display:block}

/* Volume */
.vp__vol-group{display:flex;align-items:center;gap:2px}
.vp__vol-range{width:64px;height:3px;appearance:none;-webkit-appearance:none;background:rgba(255,255,255,.3);border-radius:3px;cursor:pointer;accent-color:var(--gold,#b89a0c)}
.vp__vol-range::-webkit-slider-thumb{-webkit-appearance:none;width:12px;height:12px;border-radius:50%;background:var(--gold,#b89a0c);cursor:pointer}
.vp__vol-range::-moz-range-thumb{width:12px;height:12px;border-radius:50%;background:var(--gold,#b89a0c);border:none;cursor:pointer}

/* Time */
.vp__time{font-size:11px;color:rgba(255,255,255,.85);font-family:var(--font-label,monospace);letter-spacing:.04em;white-space:nowrap;padding:0 4px;display:flex;align-items:center;gap:3px}
.vp__time-sep{color:rgba(255,255,255,.45)}

/* Fullscreen */
.vp:fullscreen .vp__video,.vp:-webkit-full-screen .vp__video{object-fit:contain;width:100%;height:100%}

/* Loading spinner */
.vp.is-loading::after{content:'';position:absolute;top:50%;left:50%;width:36px;height:36px;margin:-18px 0 0 -18px;border:3px solid rgba(255,255,255,.2);border-top-color:var(--gold,#b89a0c);border-radius:50%;animation:vp-spin .7s linear infinite;z-index:5;pointer-events:none}
@keyframes vp-spin{to{transform:rotate(360deg)}}

@media(max-width:480px){
    .vp__vol-range{display:none}
    .vp__icon{width:18px;height:18px}
    .vp__overlay-play svg{width:56px;height:56px;padding:12px}
}
</style>
@endsection

@section('content')
    <!-- Hero -->
    <section class="page-hero">
        @if ($berita->cover)
            <img src="{{ media_url($berita->cover, 'assets/berita') }}" alt="{{ $berita->judul }}"
                class="page-hero__bg" aria-hidden="true" />
        @else
            <div class="page-hero__bg"></div>
        @endif
        <div class="page-hero__content">
            <div class="page-hero__left">
                <span class="page-hero__eyebrow">{{ $berita->kategori->nama ?? 'Berita' }}</span>
                <h1 class="page-hero__title" style="font-size:clamp(22px,3vw,36px)">{{ $berita->judul }}</h1>
            </div>
            <div class="page-hero__right">
                <span class="page-hero__accent">
                    {{ $berita->published_at ? $berita->published_at->translatedFormat('d F Y') : '' }}
                </span>
            </div>
        </div>
    </section>

    <!-- Article content -->
    <section class="page-section">
        <div class="page-inner">
            <div class="berita-detail-layout">

                <!-- Body -->
                <article class="berita-detail-body">
                    <div class="berita-detail__meta">
                        <a href="{{ route('artikel.berita', ['kategori' => $berita->kategori->slug ?? '']) }}"
                            class="berita-tag">{{ $berita->kategori->nama ?? '' }}</a>
                        <span class="berita-date">
                            {{ $berita->published_at ? $berita->published_at->translatedFormat('d F Y') : '' }}
                        </span>
                        @if ($berita->penulis)
                            <span class="berita-author">Oleh: {{ $berita->penulis }}</span>
                        @endif
                    </div>

                    {{-- Media Display Section --}}
                    <div class="berita-detail__media">
                        @if ($berita->media_type === 'image' && $berita->gambar)
                            <figure class="berita-media-wrapper">
                                <img src="{{ media_url($berita->gambar, 'assets/berita') }}"
                                    alt="{{ $berita->judul }}" class="berita-media-image" />
                            </figure>
                        @elseif ($berita->media_type === 'video' && $berita->video_path)
                            <div class="berita-media-wrapper berita-media-video-wrapper">
                                <div class="vp" id="vp-berita" role="region" aria-label="Video Player">

                                    {{-- Video element --}}
                                    <video class="vp__video" preload="metadata">
                                        <source src="{{ media_url($berita->video_path, 'assets/berita') }}"
                                            type="video/{{ pathinfo($berita->video_path, PATHINFO_EXTENSION) ?: 'mp4' }}">
                                        Browser Anda tidak mendukung video HTML5.
                                    </video>

                                    {{-- Big play button overlay (before first play) --}}
                                    <button class="vp__overlay-play" aria-label="Putar video">
                                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                                    </button>

                                    {{-- Controls bar --}}
                                    <div class="vp__controls">
                                        {{-- Progress bar --}}
                                        <div class="vp__progress-wrap">
                                            <div class="vp__progress-bg"></div>
                                            <div class="vp__progress-buf"></div>
                                            <div class="vp__progress-fill"></div>
                                            <input class="vp__seek" type="range" min="0" max="100" step="0.05" value="0" aria-label="Posisi video">
                                        </div>

                                        {{-- Bottom row --}}
                                        <div class="vp__bar">
                                            <div class="vp__bar-left">
                                                {{-- Play / Pause --}}
                                                <button class="vp__btn vp__btn--play" aria-label="Putar / Jeda">
                                                    <svg class="vp__icon vp__icon--play" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                                                    <svg class="vp__icon vp__icon--pause" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                                </button>

                                                {{-- Volume --}}
                                                <div class="vp__vol-group">
                                                    <button class="vp__btn vp__btn--mute" aria-label="Matikan / Hidupkan suara">
                                                        <svg class="vp__icon vp__icon--vol" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3A4.5 4.5 0 0 0 14 7.97v8.05A4.5 4.5 0 0 0 16.5 12zM14 3.23v2.06A7 7 0 0 1 19 12a7 7 0 0 1-5 6.71v2.06A9 9 0 0 0 21 12 9 9 0 0 0 14 3.23z"/></svg>
                                                        <svg class="vp__icon vp__icon--muted" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16.5 12A4.5 4.5 0 0 0 14 7.97v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51A8.94 8.94 0 0 0 21 12a9 9 0 0 0-7-8.77v2.06A7.01 7.01 0 0 1 19 12zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25A6.97 6.97 0 0 1 14 18.98v2.06a9 9 0 0 0 3.77-2.21L19.73 21 21 19.73 4.27 3zM12 4L9.91 6.09 12 8.18V4z"/></svg>
                                                    </button>
                                                    <input class="vp__vol-range" type="range" min="0" max="1" step="0.02" value="1" aria-label="Volume">
                                                </div>

                                                {{-- Time --}}
                                                <span class="vp__time">
                                                    <span class="vp__current">0:00</span>
                                                    <span class="vp__time-sep">/</span>
                                                    <span class="vp__duration">0:00</span>
                                                </span>
                                            </div>

                                            <div class="vp__bar-right">
                                                {{-- Fullscreen --}}
                                                <button class="vp__btn vp__btn--fs" aria-label="Layar penuh">
                                                    <svg class="vp__icon vp__icon--expand" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"/></svg>
                                                    <svg class="vp__icon vp__icon--compress" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M5 16h3v3h2v-5H5v2zm3-8H5v2h5V5H8v3zm6 11h2v-3h3v-2h-5v5zm2-11V5h-2v5h5V8h-3z"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif ($berita->media_type === 'youtube' && $berita->youtube_url)
                            <div class="berita-media-wrapper berita-media-youtube">
                                @php
                                    // Extract YouTube video ID from various URL formats
                                    // Supports: youtube.com/watch?v=ID, youtu.be/ID, youtube.com/embed/ID, youtube.com/v/ID
                                    $videoId = '';
                                    $url = $berita->youtube_url;
                                    
                                    // Try different patterns
                                    if (preg_match('/(?:youtube\.com\/watch\?v=|youtube\.com\/v\/|youtube\.com\/embed\/)([^&\n?#]+)/', $url, $matches)) {
                                        $videoId = $matches[1];
                                    } elseif (preg_match('/youtu\.be\/([^&\n?#]+)/', $url, $matches)) {
                                        $videoId = $matches[1];
                                    }
                                @endphp
                                @if ($videoId)
                                    <iframe class="berita-youtube-frame" 
                                        src="https://www.youtube.com/embed/{{ $videoId }}?rel=0"
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen
                                        loading="lazy"
                                        title="{{ $berita->judul }}"></iframe>
                                @else
                                    <div style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; background: rgba(0,0,0,0.5); color: #fff; font-size: 14px;">
                                        URL YouTube tidak valid
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    @if ($berita->ringkasan)
                        <p class="berita-detail__lead">{{ $berita->ringkasan }}</p>
                    @endif

                    <div class="berita-detail__isi prose">
                        {!! $berita->isi !!}
                    </div>

                    <div class="berita-detail__back">
                        <a href="{{ route('artikel.berita') }}" class="btn-back">
                            &larr; Kembali ke Berita
                        </a>
                    </div>
                </article>

                <!-- Sidebar: related -->
                @if ($related->isNotEmpty())
                    <aside class="berita-detail-sidebar">
                        <div class="sidebar-related">
                            <div class="sidebar-related__title">Berita Terkait</div>
                            @foreach ($related as $rel)
                                <a href="{{ route('artikel.berita.show', $rel->slug) }}" class="sidebar-related__item">
                                    <div class="sidebar-related__img-wrap" style="position:relative">
                                        @if ($rel->media_type === 'image' && $rel->gambar)
                                            <img src="{{ media_url($rel->gambar, 'assets/berita') }}"
                                                alt="{{ $rel->judul }}" class="sidebar-related__img" />
                                        @elseif ($rel->media_type === 'video' && $rel->video_path)
                                            <img src="{{ asset('compro_assets/image/hero.jpg') }}" alt=""
                                                class="sidebar-related__img" />
                                            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.3);border-radius:8px">
                                                <span style="font-size:24px">🎥</span>
                                            </div>
                                        @elseif ($rel->media_type === 'youtube' && $rel->youtube_url)
                                            <img src="{{ asset('compro_assets/image/hero.jpg') }}" alt=""
                                                class="sidebar-related__img" />
                                            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.3);border-radius:8px">
                                                <span style="font-size:24px">▶️</span>
                                            </div>
                                        @else
                                            <img src="{{ asset('compro_assets/image/hero.jpg') }}" alt=""
                                                class="sidebar-related__img" />
                                        @endif
                                    </div>
                                    <div class="sidebar-related__body">
                                        <div class="sidebar-related__date">
                                            {{ $rel->published_at ? $rel->published_at->translatedFormat('d M Y') : '' }}
                                        </div>
                                        <div class="sidebar-related__judul">{{ $rel->judul }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </aside>
                @endif

            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
(function () {
    'use strict';

    const root = document.getElementById('vp-berita');
    if (!root) return;

    const video    = root.querySelector('.vp__video');
    const overlay  = root.querySelector('.vp__overlay-play');
    const controls = root.querySelector('.vp__controls');
    const seekEl   = root.querySelector('.vp__seek');
    const fillEl   = root.querySelector('.vp__progress-fill');
    const bufEl    = root.querySelector('.vp__progress-buf');
    const btnPlay  = root.querySelector('.vp__btn--play');
    const btnMute  = root.querySelector('.vp__btn--mute');
    const volEl    = root.querySelector('.vp__vol-range');
    const btnFs    = root.querySelector('.vp__btn--fs');
    const curEl    = root.querySelector('.vp__current');
    const durEl    = root.querySelector('.vp__duration');

    // ── Helpers ───────────────────────────────────────────────
    function fmtTime(s) {
        s = Math.floor(s || 0);
        const m = Math.floor(s / 60);
        const sec = String(s % 60).padStart(2, '0');
        return m + ':' + sec;
    }

    function setPlaying(playing) {
        root.classList.toggle('is-playing', playing);
        root.classList.toggle('is-paused', !playing);
    }

    // ── Metadata loaded ───────────────────────────────────────
    video.addEventListener('loadedmetadata', () => {
        durEl.textContent = fmtTime(video.duration);
        seekEl.max = video.duration;
    });

    // ── Time update ───────────────────────────────────────────
    video.addEventListener('timeupdate', () => {
        if (!video.duration) return;
        const pct = (video.currentTime / video.duration) * 100;
        fillEl.style.width = pct + '%';
        seekEl.value = video.currentTime;
        curEl.textContent = fmtTime(video.currentTime);
    });

    // ── Buffered ──────────────────────────────────────────────
    video.addEventListener('progress', () => {
        if (!video.duration || !video.buffered.length) return;
        const pct = (video.buffered.end(video.buffered.length - 1) / video.duration) * 100;
        bufEl.style.width = pct + '%';
    });

    // ── Loading state ─────────────────────────────────────────
    video.addEventListener('waiting', () => root.classList.add('is-loading'));
    video.addEventListener('playing', () => root.classList.remove('is-loading'));
    video.addEventListener('canplay', () => root.classList.remove('is-loading'));

    // ── Play / Pause ──────────────────────────────────────────
    function togglePlay() {
        if (video.paused) {
            video.play();
            overlay.classList.add('is-hidden');
        } else {
            video.pause();
        }
    }

    video.addEventListener('play',  () => setPlaying(true));
    video.addEventListener('pause', () => setPlaying(false));
    video.addEventListener('ended', () => {
        setPlaying(false);
        overlay.classList.remove('is-hidden');
        video.currentTime = 0;
    });

    overlay.addEventListener('click', togglePlay);
    btnPlay.addEventListener('click', (e) => { e.stopPropagation(); togglePlay(); });
    video.addEventListener('click', togglePlay);

    // ── Seek ──────────────────────────────────────────────────
    seekEl.addEventListener('input', () => {
        video.currentTime = seekEl.value;
    });

    // ── Volume ────────────────────────────────────────────────
    function syncMute() {
        root.classList.toggle('is-muted', video.muted || video.volume === 0);
    }

    volEl.addEventListener('input', () => {
        video.volume = volEl.value;
        video.muted  = volEl.value == 0;
        syncMute();
    });

    btnMute.addEventListener('click', () => {
        video.muted = !video.muted;
        if (!video.muted && video.volume === 0) {
            video.volume = 0.5;
            volEl.value  = 0.5;
        }
        syncMute();
    });

    video.addEventListener('volumechange', () => {
        volEl.value = video.muted ? 0 : video.volume;
        syncMute();
    });

    // ── Fullscreen ────────────────────────────────────────────
    function isFs() {
        return !!(document.fullscreenElement || document.webkitFullscreenElement);
    }

    btnFs.addEventListener('click', () => {
        if (!isFs()) {
            (root.requestFullscreen || root.webkitRequestFullscreen).call(root);
        } else {
            (document.exitFullscreen || document.webkitExitFullscreen).call(document);
        }
    });

    document.addEventListener('fullscreenchange',       () => root.classList.toggle('is-fullscreen', isFs()));
    document.addEventListener('webkitfullscreenchange', () => root.classList.toggle('is-fullscreen', isFs()));

    // ── Keyboard shortcuts (when focused) ────────────────────
    root.setAttribute('tabindex', '0');
    root.addEventListener('keydown', (e) => {
        if (e.key === ' ' || e.key === 'k')       { e.preventDefault(); togglePlay(); }
        else if (e.key === 'm')                    { btnMute.click(); }
        else if (e.key === 'f')                    { btnFs.click(); }
        else if (e.key === 'ArrowRight')           { video.currentTime = Math.min(video.duration, video.currentTime + 5); }
        else if (e.key === 'ArrowLeft')            { video.currentTime = Math.max(0, video.currentTime - 5); }
        else if (e.key === 'ArrowUp')              { video.volume = Math.min(1, video.volume + 0.1); volEl.value = video.volume; syncMute(); }
        else if (e.key === 'ArrowDown')            { video.volume = Math.max(0, video.volume - 0.1); volEl.value = video.volume; syncMute(); }
    });
})();
</script>
@endsection
