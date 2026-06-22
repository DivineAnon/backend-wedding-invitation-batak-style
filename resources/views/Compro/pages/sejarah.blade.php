@extends('Compro.Layouts.Compro')

@section('title', 'Sejarah — Paroki Mataram')

@section('content')
    <!-- Hero -->
    <section class="page-hero">
        @if ($sejarah->hero_image)
            <img src="{{ media_url($sejarah->hero_image, 'assets/sejarah') }}" alt="" class="page-hero__bg" aria-hidden="true" />
        @else
            <div class="page-hero__bg"></div>
        @endif
        <div class="page-hero__content">
            <div class="page-hero__left">
                <span class="page-hero__eyebrow">Profil Paroki</span>
                <h1 class="page-hero__title">Sejarah</h1>
            </div>
            <div class="page-hero__right">
                <span class="page-hero__accent">{{ $sejarah->accent_text }}</span>
            </div>
        </div>
    </section>

    <!-- Narasi utama -->
    <section class="page-section">
        <div class="page-inner">
            <div class="page-2col">
                <div class="page-2col__label">
                    <span class="page-label">{{ $sejarah->label }}</span>
                    <span class="page-year">{{ $sejarah->year }}</span>
                </div>
                <div class="page-body">
                    @foreach ($sejarah->body as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach

                    @if ($sejarah->source)
                        <span class="page-source">Sumber: {{ $sejarah->source }}</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline milestones -->
    @if ($sejarah->milestones->isNotEmpty())
        <section class="page-section page-section--alt">
            <div class="page-inner">
                <p class="page-section-title">Tonggak Sejarah</p>
                <div class="timeline">
                    @foreach ($sejarah->milestones as $milestone)
                        <div class="timeline__item">
                            <span class="timeline__year">{{ $milestone->tahun }}</span>
                            <div class="timeline__body">
                                <p class="timeline__title">{{ $milestone->judul }}</p>
                                <p class="timeline__text">{{ $milestone->deskripsi }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
