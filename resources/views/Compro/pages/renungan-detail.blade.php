@extends('Compro.Layouts.Compro')

@section('title', $renungan->judul . ' — Paroki Santo Yoseph Matraman')

@section('content')
    <!-- Header -->
    <section class="page-hero">
        <div class="page-hero__bg"></div>
        <div class="page-hero__content">
            <div class="page-hero__left">
                <span class="page-hero__eyebrow">{{ $renungan->tema ?? 'Renungan' }}</span>
                <h1 class="page-hero__title" style="font-size:clamp(22px,3vw,38px)">{{ $renungan->judul }}</h1>
            </div>
            <div class="page-hero__right">
                <span class="page-hero__accent">
                    {{ $renungan->published_at ? $renungan->published_at->translatedFormat('d F Y') : '' }}
                </span>
                @if ($renungan->penulis)
                    <div class="page-hero__author">Oleh: <strong>{{ $renungan->penulis }}</strong></div>
                @endif
            </div>
        </div>
    </section>

    <!-- Detail Content -->
    <section class="page-section">
        <div class="page-inner">
            <div class="renungan-detail-layout">

                <!-- Article -->
                <article class="renungan-detail-body">

                    @if ($renungan->video)
                        <div class="renungan-media-wrapper renungan-media-video-wrapper">
                            <div class="vp" id="vp-renungan" role="region" aria-label="Video Player">
                                <video class="vp__video" preload="metadata">
                                    <source src="{{ media_url($renungan->video, 'compro_assets/media/renungan') }}"
                                        type="video/{{ pathinfo($renungan->video, PATHINFO_EXTENSION) ?: 'mp4' }}">
                                    Browser Anda tidak mendukung video HTML5.
                                </video>
                                <button class="vp__overlay-play" aria-label="Putar video">
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                                </button>
                                <div class="vp__controls">
                                    <div class="vp__progress-wrap">
                                        <div class="vp__progress-bg"></div>
                                        <div class="vp__progress-buf"></div>
                                        <div class="vp__progress-fill"></div>
                                        <input class="vp__seek" type="range" min="0" max="100" step="0.05" value="0" aria-label="Posisi video">
                                    </div>
                                    <div class="vp__bar">
                                        <div class="vp__bar-left">
                                            <button class="vp__btn vp__btn--play" aria-label="Putar / Jeda">
                                                <svg class="vp__icon vp__icon--play" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                                                <svg class="vp__icon vp__icon--pause" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                            </button>
                                            <div class="vp__vol-group">
                                                <button class="vp__btn vp__btn--mute" aria-label="Matikan / Hidupkan suara">
                                                    <svg class="vp__icon vp__icon--vol" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3A4.5 4.5 0 0 0 14 7.97v8.05A4.5 4.5 0 0 0 16.5 12zM14 3.23v2.06A7 7 0 0 1 19 12a7 7 0 0 1-5 6.71v2.06A9 9 0 0 0 21 12 9 9 0 0 0 14 3.23z"/></svg>
                                                    <svg class="vp__icon vp__icon--muted" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16.5 12A4.5 4.5 0 0 0 14 7.97v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51A8.94 8.94 0 0 0 21 12a9 9 0 0 0-7-8.77v2.06A7.01 7.01 0 0 1 19 12zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25A6.97 6.97 0 0 1 14 18.98v2.06a9 9 0 0 0 3.77-2.21L19.73 21 21 19.73 4.27 3zM12 4L9.91 6.09 12 8.18V4z"/></svg>
                                                </button>
                                                <input class="vp__vol-range" type="range" min="0" max="1" step="0.02" value="1" aria-label="Volume">
                                            </div>
                                            <span class="vp__time">
                                                <span class="vp__current">0:00</span>
                                                <span class="vp__time-sep">/</span>
                                                <span class="vp__duration">0:00</span>
                                            </span>
                                        </div>
                                        <div class="vp__bar-right">
                                            <button class="vp__btn vp__btn--fs" aria-label="Layar penuh">
                                                <svg class="vp__icon vp__icon--expand" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"/></svg>
                                                <svg class="vp__icon vp__icon--compress" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M5 16h3v3h2v-5H5v2zm3-8H5v2h5V5H8v3zm6 11h2v-3h3v-2h-5v5zm2-11V5h-2v5h5V8h-3z"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($renungan->gambar)
                        <figure class="renungan-media-wrapper">
                            <img src="{{ media_url($renungan->gambar, 'compro_assets/image/renungan') }}"
                                alt="{{ $renungan->judul }}" class="renungan-media-image" />
                        </figure>
                    @endif

                    @if ($renungan->kutipan)
                        <blockquote class="renungan-detail__scripture">
                            <span class="renungan-detail__scripture-mark" aria-hidden="true">❝</span>
                            {{ $renungan->kutipan }}
                        </blockquote>
                    @endif

                    <div class="renungan-detail__isi prose">
                        {!! $renungan->isi !!}
                    </div>

                    <div class="renungan-detail__back">
                        <a href="{{ route('artikel.renungan') }}" class="btn-back">
                            &larr; Kembali ke Renungan
                        </a>
                    </div>
                </article>

                <!-- Sidebar: related -->
                @if ($related->isNotEmpty())
                    <aside class="renungan-detail-sidebar">
                        <div class="sidebar-renungan">
                            <h4 class="sidebar-renungan__title">Renungan Lainnya</h4>
                            <div class="sidebar-renungan__list">
                                @foreach ($related as $r)
                                    <a href="{{ route('artikel.renungan.show', $r->slug) }}" class="sidebar-renungan__item">
                                        @if ($r->tema)
                                            <span class="renungan-tema-tag renungan-tema-tag--sm">{{ $r->tema }}</span>
                                        @endif
                                        <div class="sidebar-renungan__item-title">{{ $r->judul }}</div>
                                        @if ($r->kutipan)
                                            <div class="sidebar-renungan__item-quote">{{ Str::limit($r->kutipan, 70) }}
                                            </div>
                                        @endif
                                        <div class="sidebar-renungan__item-date">
                                            {{ $r->published_at ? $r->published_at->translatedFormat('d M Y') : '' }}
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                @endif

            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
/* ── Renungan Media Block ────────────────────────────── */
.renungan-media-wrapper{margin:0 0 28px;border-radius:10px;overflow:hidden;box-shadow:0 6px 24px rgba(0,0,0,0.12)}
.renungan-media-image{width:100%;display:block;height:auto;object-fit:contain}
.renungan-media-video-wrapper{aspect-ratio:16/9;background:#000;border-radius:10px;overflow:hidden;padding:0}

/* ── Custom Video Player (vp) ─────────────────────────── */
.vp{position:relative;width:100%;height:100%;background:#000;display:flex;align-items:stretch;overflow:hidden;user-select:none;-webkit-user-select:none}
.vp__video{width:100%;height:100%;display:block;object-fit:contain;background:#000}
.vp__overlay-play{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.35);border:none;cursor:pointer;transition:background .2s ease,opacity .2s ease;z-index:3;padding:0}
.vp__overlay-play svg{width:72px;height:72px;color:var(--ivory,#faf6ee);filter:drop-shadow(0 2px 8px rgba(0,0,0,.5));background:var(--gold,#b89a0c);border-radius:50%;padding:16px;transition:transform .18s ease,background .18s ease}
.vp__overlay-play:hover svg{background:var(--burgundy,#6d2b35);transform:scale(1.08)}
.vp__overlay-play.is-hidden{opacity:0;pointer-events:none}
.vp__controls{position:absolute;bottom:0;left:0;right:0;padding:0 0 4px;background:linear-gradient(to top,rgba(0,0,0,.75) 0%,transparent 100%);transform:translateY(100%);transition:transform .22s ease,opacity .22s ease;opacity:0;z-index:4}
.vp:hover .vp__controls,.vp.is-paused .vp__controls,.vp.is-loading .vp__controls{transform:translateY(0);opacity:1}
.vp__progress-wrap{position:relative;width:100%;height:18px;display:flex;align-items:center;cursor:pointer;padding:0 12px}
.vp__progress-bg,.vp__progress-buf,.vp__progress-fill{position:absolute;left:12px;right:12px;height:3px;border-radius:3px;pointer-events:none;transition:height .12s ease}
.vp__progress-wrap:hover .vp__progress-bg,.vp__progress-wrap:hover .vp__progress-buf,.vp__progress-wrap:hover .vp__progress-fill{height:5px}
.vp__progress-bg{background:rgba(255,255,255,.2)}
.vp__progress-buf{background:rgba(255,255,255,.35);width:0%;right:auto}
.vp__progress-fill{background:var(--gold,#b89a0c);width:0%;right:auto}
.vp__seek{position:absolute;left:12px;right:12px;width:calc(100% - 24px);height:18px;opacity:0;cursor:pointer;margin:0;padding:0;appearance:none;-webkit-appearance:none;background:transparent}
.vp__bar{display:flex;align-items:center;justify-content:space-between;padding:0 8px 4px;gap:6px}
.vp__bar-left,.vp__bar-right{display:flex;align-items:center;gap:4px}
.vp__btn{background:none;border:none;cursor:pointer;color:rgba(255,255,255,.9);display:flex;align-items:center;justify-content:center;padding:5px;border-radius:4px;transition:color .15s,background .15s;flex-shrink:0;line-height:1}
.vp__btn:hover{color:var(--gold,#b89a0c);background:rgba(255,255,255,.08)}
.vp__icon{width:20px;height:20px;display:block;pointer-events:none}
.vp__icon--pause,.vp__icon--muted,.vp__icon--compress{display:none}
.vp.is-playing .vp__icon--play{display:none}
.vp.is-playing .vp__icon--pause{display:block}
.vp.is-muted .vp__icon--vol{display:none}
.vp.is-muted .vp__icon--muted{display:block}
.vp.is-fullscreen .vp__icon--expand{display:none}
.vp.is-fullscreen .vp__icon--compress{display:block}
.vp__vol-group{display:flex;align-items:center;gap:2px}
.vp__vol-range{width:64px;height:3px;appearance:none;-webkit-appearance:none;background:rgba(255,255,255,.3);border-radius:3px;cursor:pointer;accent-color:var(--gold,#b89a0c)}
.vp__vol-range::-webkit-slider-thumb{-webkit-appearance:none;width:12px;height:12px;border-radius:50%;background:var(--gold,#b89a0c);cursor:pointer}
.vp__vol-range::-moz-range-thumb{width:12px;height:12px;border-radius:50%;background:var(--gold,#b89a0c);border:none;cursor:pointer}
.vp__time{font-size:11px;color:rgba(255,255,255,.85);font-family:var(--font-label,monospace);letter-spacing:.04em;white-space:nowrap;padding:0 4px;display:flex;align-items:center;gap:3px}
.vp__time-sep{color:rgba(255,255,255,.45)}
.vp:fullscreen .vp__video,.vp:-webkit-full-screen .vp__video{object-fit:contain;width:100%;height:100%}
.vp.is-loading::after{content:'';position:absolute;top:50%;left:50%;width:36px;height:36px;margin:-18px 0 0 -18px;border:3px solid rgba(255,255,255,.2);border-top-color:var(--gold,#b89a0c);border-radius:50%;animation:vp-spin .7s linear infinite;z-index:5;pointer-events:none}
@keyframes vp-spin{to{transform:rotate(360deg)}}
@media(max-width:480px){.vp__vol-range{display:none}.vp__icon{width:18px;height:18px}.vp__overlay-play svg{width:56px;height:56px;padding:12px}}
</style>
@endsection

@section('scripts')
<script>
(function () {
    'use strict';
    const root = document.getElementById('vp-renungan');
    if (!root) return;
    const video   = root.querySelector('.vp__video');
    const overlay = root.querySelector('.vp__overlay-play');
    const seekEl  = root.querySelector('.vp__seek');
    const fillEl  = root.querySelector('.vp__progress-fill');
    const bufEl   = root.querySelector('.vp__progress-buf');
    const btnPlay = root.querySelector('.vp__btn--play');
    const btnMute = root.querySelector('.vp__btn--mute');
    const volEl   = root.querySelector('.vp__vol-range');
    const btnFs   = root.querySelector('.vp__btn--fs');
    const curEl   = root.querySelector('.vp__current');
    const durEl   = root.querySelector('.vp__duration');
    function fmtTime(s){s=Math.floor(s||0);const m=Math.floor(s/60),sec=String(s%60).padStart(2,'0');return m+':'+sec;}
    function setPlaying(p){root.classList.toggle('is-playing',p);root.classList.toggle('is-paused',!p);}
    video.addEventListener('loadedmetadata',()=>{durEl.textContent=fmtTime(video.duration);seekEl.max=video.duration;});
    video.addEventListener('timeupdate',()=>{if(!video.duration)return;const pct=(video.currentTime/video.duration)*100;fillEl.style.width=pct+'%';seekEl.value=video.currentTime;curEl.textContent=fmtTime(video.currentTime);});
    video.addEventListener('progress',()=>{if(!video.duration||!video.buffered.length)return;const pct=(video.buffered.end(video.buffered.length-1)/video.duration)*100;bufEl.style.width=pct+'%';});
    video.addEventListener('waiting',()=>root.classList.add('is-loading'));
    video.addEventListener('playing',()=>root.classList.remove('is-loading'));
    video.addEventListener('canplay',()=>root.classList.remove('is-loading'));
    function togglePlay(){if(video.paused){video.play();overlay.classList.add('is-hidden');}else{video.pause();}}
    video.addEventListener('play',()=>setPlaying(true));
    video.addEventListener('pause',()=>setPlaying(false));
    video.addEventListener('ended',()=>{setPlaying(false);overlay.classList.remove('is-hidden');video.currentTime=0;});
    overlay.addEventListener('click',togglePlay);
    btnPlay.addEventListener('click',(e)=>{e.stopPropagation();togglePlay();});
    video.addEventListener('click',togglePlay);
    seekEl.addEventListener('input',()=>{video.currentTime=seekEl.value;});
    function syncMute(){root.classList.toggle('is-muted',video.muted||video.volume===0);}
    volEl.addEventListener('input',()=>{video.volume=volEl.value;video.muted=volEl.value==0;syncMute();});
    btnMute.addEventListener('click',()=>{video.muted=!video.muted;if(!video.muted&&video.volume===0){video.volume=0.5;volEl.value=0.5;}syncMute();});
    video.addEventListener('volumechange',()=>{volEl.value=video.muted?0:video.volume;syncMute();});
    function isFs(){return!!(document.fullscreenElement||document.webkitFullscreenElement);}
    btnFs.addEventListener('click',()=>{if(!isFs()){(root.requestFullscreen||root.webkitRequestFullscreen).call(root);}else{(document.exitFullscreen||document.webkitExitFullscreen).call(document);}});
    document.addEventListener('fullscreenchange',()=>root.classList.toggle('is-fullscreen',isFs()));
    document.addEventListener('webkitfullscreenchange',()=>root.classList.toggle('is-fullscreen',isFs()));
    root.setAttribute('tabindex','0');
    root.addEventListener('keydown',(e)=>{if(e.key===' '||e.key==='k'){e.preventDefault();togglePlay();}else if(e.key==='m'){btnMute.click();}else if(e.key==='f'){btnFs.click();}else if(e.key==='ArrowRight'){video.currentTime=Math.min(video.duration,video.currentTime+5);}else if(e.key==='ArrowLeft'){video.currentTime=Math.max(0,video.currentTime-5);}else if(e.key==='ArrowUp'){video.volume=Math.min(1,video.volume+0.1);volEl.value=video.volume;syncMute();}else if(e.key==='ArrowDown'){video.volume=Math.max(0,video.volume-0.1);volEl.value=video.volume;syncMute();}});
})();
</script>
@endsection
