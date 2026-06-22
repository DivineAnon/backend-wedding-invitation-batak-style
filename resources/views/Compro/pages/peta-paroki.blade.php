@extends('Compro.Layouts.Compro')

@section('title', 'Peta Paroki — Paroki Santo Yoseph Matraman')

@section('content')
    <!-- Hero -->
    <section class="page-hero">
        @if ($peta->hero_image)
            <img src="{{ media_url($peta->hero_image, 'assets/peta-paroki') }}" alt="" class="page-hero__bg" aria-hidden="true" />
        @else
            <div class="page-hero__bg"></div>
        @endif
        <div class="page-hero__content">
            <div class="page-hero__left">
                <span class="page-hero__eyebrow">Profil Paroki</span>
                <h1 class="page-hero__title">Peta Paroki</h1>
            </div>
            <div class="page-hero__right">
                <span class="page-hero__accent">{{ $peta->accent_text ?? $peta->alamat }}</span>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="page-section">
        <div class="page-inner">
            @if ($peta->maps_embed_url)
                <div class="map-embed map-embed--iframe">
                    <iframe src="{{ $peta->maps_embed_url }}" title="Lokasi Paroki Santo Yoseph Matraman"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                </div>
            @else
                <div class="map-embed">
                    <img src="{{ $peta->gambar ? media_url($peta->gambar, 'compro_assets/image') : asset('compro_assets/image/peta_paroki.jpg') }}"
                        alt="Peta Paroki Santo Yoseph Matraman" />
                </div>
            @endif

            <div class="map-info">
                @if ($peta->alamat)
                    <div class="map-info__item">
                        <span class="map-info__label">Alamat</span>
                        <span class="map-info__value">{{ $peta->alamat }}<br />{{ $peta->kota }}</span>
                    </div>
                @endif
                @if ($peta->telepon)
                    <div class="map-info__item">
                        <span class="map-info__label">Telepon &amp; Faks</span>
                        <span class="map-info__value">{{ $peta->telepon }}@if ($peta->faks)<br />{{ $peta->faks }}@endif</span>
                    </div>
                @endif
                @if ($peta->email)
                    <div class="map-info__item">
                        <span class="map-info__label">Email</span>
                        <span class="map-info__value">{{ $peta->email }}</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Jam Pelayanan -->
    <section class="page-section page-section--alt">
        <div class="page-inner">
            <div class="page-2col">
                <div class="page-2col__label">
                    <span class="page-label">Jam Pelayanan</span>
                    <span class="page-year">Open</span>
                </div>
                <div class="page-body">
                    <div class="jadwal-ops">
                        @if ($peta->jam_senin_jumat)
                            <div class="jadwal-ops__item">
                                <span class="jadwal-ops__day">Senin — Jumat</span>
                                <span class="jadwal-ops__time">{{ $peta->jam_senin_jumat }}</span>
                            </div>
                        @endif
                        @if ($peta->jam_sabtu)
                            <div class="jadwal-ops__item">
                                <span class="jadwal-ops__day">Sabtu</span>
                                <span class="jadwal-ops__time">{{ $peta->jam_sabtu }}</span>
                            </div>
                        @endif
                        @if ($peta->jam_minggu)
                            <div class="jadwal-ops__item">
                                <span class="jadwal-ops__day">Minggu</span>
                                <span class="jadwal-ops__time">{{ $peta->jam_minggu }}</span>
                            </div>
                        @endif
                    </div>
                    @if ($peta->catatan_pelayanan)
                        <p style="margin-top: 48px">{{ $peta->catatan_pelayanan }}</p>
                    @else
                        <p style="margin-top: 48px">
                            Sekretariat Paroki melayani keperluan administrasi sakramen, surat
                            menyurat, dan pelayanan pastoral selama jam kerja. Silakan
                            menghubungi terlebih dahulu untuk keperluan khusus di luar jam
                            tersebut.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .map-embed--iframe iframe {
        width: 100%;
        height: 400px;
        border: none;
        border-radius: 8px;
    }
</style>
@endsection
