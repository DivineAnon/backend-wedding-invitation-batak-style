@extends('Compro.Layouts.Compro')

@section('title', 'Parokimatraman')

@section('content')
    <section class="hero" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.1) 40%, rgba(0,0,0,0.75) 100%), url('{{ media_url($hero->hero_image, 'assets/beranda') }}');">
        <div class="hero__inner">
            <p class="hero__tagline">{!! nl2br(e($hero->tagline)) !!}</p>
            <div class="hero__card">
                <h3 class="hero__card-title">{{ $hero->card_title }}</h3>
                <p class="hero__card-desc">{{ $hero->card_desc }}</p>
                <a href="{{ $hero->button_link }}" class="button-primary font-italic">({{ $hero->button_text }})</a>
            </div>
        </div>
    </section>

    <section class="section-2" id="jadwal-misa">
        <div class="jadwal">
            <div class="jadwal__header">
                <p class="jadwal__label">{{ $page->jadwal_label }}</p>
                <h2 class="jadwal__title">{!! nl2br(e($page->jadwal_title)) !!}</h2>
            </div>
            <div class="jadwal__grid">
                @foreach ($jadwals as $hariGroup => $items)
                    <div class="jadwal__card {{ $hariGroup === 'Minggu' ? 'jadwal__card--highlight' : '' }}">
                        <span class="jadwal__hari">{{ $hariGroup }}</span>
                        <div class="jadwal__list">
                            @foreach ($items->sortBy('urutan') as $j)
                                <div class="jadwal__item">
                                    <span class="jadwal__waktu">{{ $j->jam }}</span>
                                    <span class="jadwal__nama font-bold">{{ $j->tipe }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="sejarah" class="sejarah">
        <div class="sejarah__inner">
            <div class="sejarah__left">
                <span class="sejarah__label">{{ $page->sejarah_label }}</span>
                <p class="sejarah__body">{{ $page->sejarah_body1 }}</p>
                <p class="sejarah__body">{{ $page->sejarah_body2 }}</p>
                <a href="{{ route('profil.sejarah') }}" class="button-primary font-italic">({{ $page->sejarah_button_text }})</a>
            </div>

            <div class="sejarah__right">
                <p class="sejarah__quote">{{ $page->sejarah_quote }}</p>
                <div class="sejarah__img-wrap">
                    @if ($sejarah && $sejarah->hero_image)
                        <img src="{{ media_url($sejarah->hero_image, 'assets/sejarah') }}" alt="Gereja Paroki Mataram"
                            class="sejarah__img" />
                    @else
                        <img src="{{ asset('compro_assets/image/hero.jpg') }}" alt="Gereja Paroki Mataram"
                            class="sejarah__img" />
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ===== RENUNGAN SECTION ===== --}}
    @if ($renungans->isNotEmpty())
    <section class="hn-renungan" id="renungan">
        <div class="hn-renungan__inner">

            <div class="hn-renungan__header">
                <div class="hn-renungan__header-left">
                    <span class="hn-renungan__eyebrow">{{ $page->renungan_eyebrow }}</span>
                    <h2 class="hn-renungan__title">{{ $page->renungan_title }}</h2>
                </div>
                <p class="hn-renungan__sub">{{ $page->renungan_sub }}</p>
            </div>

            <div class="hn-renungan__grid">
                @foreach ($renungans as $i => $r)
                    @php $isFeatured = ($i === 0); @endphp
                    <a href="{{ route('artikel.renungan.show', $r->slug) }}"
                        class="hn-renungan__card {{ $isFeatured ? 'hn-renungan__card--featured' : '' }}">

                        @if ($isFeatured && ($r->gambar || $r->video))
                            <div class="hn-renungan__card-media">
                                @if ($r->gambar)
                                    <img src="{{ media_url($r->gambar, 'compro_assets/image/renungan') }}"
                                        alt="{{ $r->judul }}" />
                                @else
                                    <div class="hn-renungan__card-videothumb">
                                        <span class="hn-renungan__card-playicon" aria-hidden="true">
                                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <div class="hn-renungan__card-body">
                            <div class="hn-renungan__card-top">
                                @if ($r->tema)
                                    <span class="hn-renungan__card-tema">{{ $r->tema }}</span>
                                @endif
                                <span class="hn-renungan__card-date">
                                    {{ $r->published_at ? $r->published_at->translatedFormat('d M Y') : '' }}
                                </span>
                            </div>

                            <h3 class="hn-renungan__card-title">{{ $r->judul }}</h3>

                            @if ($r->kutipan)
                                <p class="hn-renungan__card-quote">&ldquo;{{ Str::limit($r->kutipan, $isFeatured ? 140 : 80) }}&rdquo;</p>
                            @endif

                            @if ($r->penulis)
                                <span class="hn-renungan__card-author">{{ $r->penulis }}</span>
                            @endif

                            <span class="hn-renungan__card-cta">Baca Renungan &rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="hn-renungan__footer">
                <a href="{{ route('artikel.renungan') }}" class="button-primary font-italic">({{ $page->renungan_cta }})</a>
            </div>
        </div>
    </section>
    @endif

    <section class="berita">
        <div class="berita__inner">
            <div class="berita__header">
                <div class="berita__header-left">
                    <span class="berita__label">{{ $page->berita_label }}</span>
                    @if ($beritas->isNotEmpty())
                        <span class="berita__counter">01 <span class="berita__counter-sep">—</span>
                            {{ str_pad($beritas->count(), 2, '0', STR_PAD_LEFT) }}</span>
                    @endif
                </div>
                <h2 class="berita__title">
                    {{ $page->berita_title }}
                </h2>
            </div>

            <div class="berita__viewport">
                <div class="berita__grid" id="beritaGrid">
                    @forelse ($beritas as $i => $berita)
                        @php
                            $img = $berita->cover
                                ? media_url($berita->cover, 'assets/berita')
                                : ($berita->gambar
                                    ? media_url($berita->gambar, 'assets/berita')
                                    : null);
                            $tag = $berita->kategori->nama ?? 'Berita';
                            $link = route('artikel.berita.show', $berita->slug);
                        @endphp
                        @if ($i === 0)
                            {{-- First berita: featured card --}}
                            <div class="berita__card berita__card--featured">
                                <a href="{{ $link }}"
                                    style="display:block;text-decoration:none;color:inherit;">
                                    <div class="berita__card-img-wrap berita__card-img-wrap--tall">
                                        @if ($img)
                                            <img src="{{ $img }}" alt="{{ $berita->judul }}"
                                                class="berita__card-img" />
                                        @else
                                            <div class="berita__card-img" style="background:linear-gradient(135deg,#1c0a02 0%,#0a0a0a 65%);width:100%;height:100%;"></div>
                                        @endif
                                    </div>
                                    <div class="berita__card-body">
                                        <span class="berita__card-tag">{{ $tag }}</span>
                                        <p class="berita__card-title">{{ $berita->judul }}</p>
                                    </div>
                                </a>
                            </div>
                        @else
                            {{-- Other berita: regular cards --}}
                            <div class="berita__card">
                                <a href="{{ $link }}" style="display:block;text-decoration:none;color:inherit;">
                                    <div class="berita__card-img-wrap berita__card-img-wrap--short">
                                        @if ($img)
                                            <img src="{{ $img }}" alt="{{ $berita->judul }}"
                                                class="berita__card-img berita__card-img--mono" />
                                        @else
                                            <div class="berita__card-img berita__card-img--mono" style="background:linear-gradient(135deg,#1c0a02 0%,#0a0a0a 65%);width:100%;height:100%;"></div>
                                        @endif
                                    </div>
                                    <div class="berita__card-body">
                                        <span class="berita__card-tag">{{ $tag }}</span>
                                        <p class="berita__card-title">{{ $berita->judul }}</p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @empty
                        <div style="grid-column:1/-1;text-align:center;padding:40px;color:#888;">
                            Belum ada artikel yang dipublikasikan.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="berita__nav">
                <button class="berita__nav-btn" id="beritaPrev">(prev)</button>
                <div class="berita__nav-center">
                    <span class="berita__nav-current" id="beritaCurrent">01</span>
                    <span class="berita__nav-sep">&nbsp;&mdash;&nbsp;</span>
                    <span class="berita__nav-total"
                        id="beritaTotal">{{ str_pad($beritas->count(), 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="berita__dots" id="beritaDots"></div>
                </div>
                <button class="berita__nav-btn" id="beritaNext">(next)</button>
            </div>

            <div class="berita__footer">
                <a href="{{ route('artikel.berita') }}" class="button-primary font-italic">({{ $page->berita_cta }})</a>
            </div>
        </div>
    </section>

    @if ($pengumumans->isNotEmpty())
        <section class="pengumuman">
            <div class="pengumuman__inner">
                <div class="pengumuman__topbar">
                    <div class="pengumuman__intro">
                        <span class="pengumuman__eyebrow">{{ $page->pengumuman_eyebrow }}</span>
                        <h2 class="pengumuman__title">
                            {!! nl2br(e($page->pengumuman_title)) !!}
                        </h2>
                    </div>
                    <div class="pengumuman__nav">
                        <button class="pengumuman__nav-btn" id="pengumumanPrev">(prev)</button>
                        <button class="pengumuman__nav-btn" id="pengumumanNext">(next)</button>
                    </div>
                </div>

                <div class="pengumuman__viewport">
                    <div class="pengumuman__grid" id="pengumumanGrid"></div>
                </div>

                <div class="pengumuman__footer">
                    <a href="{{ route('artikel.pengumuman') }}"
                        class="pengumuman__ view-all button-primary font-italic">({{ $page->pengumuman_cta }})</a>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('scripts')
    <script>
        window.pengumumanData = @json($pengumumans);
    </script>
    <script src="{{ asset('compro_assets/js/carousel.js') }}"></script>
    <script src="{{ asset('compro_assets/js/stories.js') }}"></script>
@endsection
