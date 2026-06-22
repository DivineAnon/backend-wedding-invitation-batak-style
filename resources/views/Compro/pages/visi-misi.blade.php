@extends('Compro.Layouts.Compro')

@section('title', 'Visi & Misi — Paroki Mataram')

@section('content')
    <!-- Hero -->
    <section class="page-hero">
        @if ($visiMisi->hero_image)
            <img src="{{ media_url($visiMisi->hero_image, 'assets/visi-misi') }}" alt="" class="page-hero__bg" aria-hidden="true" />
        @else
            <div class="page-hero__bg"></div>
        @endif
        <div class="page-hero__content">
            <div class="page-hero__left">
                <span class="page-hero__eyebrow">Profil Paroki</span>
                <h1 class="page-hero__title">Visi &amp; Misi</h1>
            </div>
            <div class="page-hero__right">
                <span class="page-hero__accent">{{ $visiMisi->accent_text ?? 'Landasan dan arah pelayanan paroki' }}</span>
            </div>
        </div>
    </section>

    <!-- Visi -->
    <section class="page-section">
        <div class="page-inner">
            <div class="page-2col">
                <div class="page-2col__label">
                    <span class="page-label">Visi</span>
                    <span class="page-year">Vision</span>
                </div>
                <div class="page-body">
                    <div class="visi-statement">
                        <p class="visi-statement__text">{{ $visiMisi->visi }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Misi intro + pillars -->
    <section class="page-section page-section--alt">
        <div class="page-inner">
            <div class="page-2col">
                <div class="page-2col__label">
                    <span class="page-label">Misi</span>
                    <span class="page-year">Mission</span>
                </div>
                <div class="page-body">
                    <p class="misi-intro">{{ $visiMisi->misi_intro }}</p>

                    <div class="misi-pillars">
                        @foreach ($visiMisi->misi_pillars ?? [] as $pillar)
                            <div class="misi-pillar">
                                <span class="misi-pillar__name">{{ $pillar['nama'] }}</span>
                                <p class="misi-pillar__text">{{ $pillar['deskripsi'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Spiritualitas -->
    <section class="page-section">
        <div class="page-inner">
            <div class="page-2col">
                <div class="page-2col__label">
                    <span class="page-label">Spiritualitas</span>
                    <span class="page-year">Spirit</span>
                </div>
                <div class="page-body">
                    @if ($visiMisi->spiritualitas)
                        <p>{{ $visiMisi->spiritualitas }}</p>
                    @endif
                    @if ($visiMisi->nilai_nilai && count($visiMisi->nilai_nilai))
                        <div class="values-list">
                            @foreach ($visiMisi->nilai_nilai as $i => $nilai)
                                <div class="value-item">
                                    <span class="value-item__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="value-item__text">{{ $nilai }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
