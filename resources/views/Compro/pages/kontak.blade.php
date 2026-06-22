@extends('Compro.Layouts.Compro')

@section('title', 'Kontak — Paroki Santo Yoseph Matraman')

@section('content')
    <!-- Hero -->
    <section class="page-hero">
        @if ($kontakPage->hero_image)
            <img src="{{ media_url($kontakPage->hero_image, 'assets/kontak') }}" alt="" class="page-hero__bg" aria-hidden="true" />
        @else
            <div class="page-hero__bg"></div>
        @endif
        <div class="page-hero__content">
            <span class="page-hero__eyebrow">Layanan</span>
            <h1 class="page-hero__title">Kontak</h1>
            <p class="page-hero__accent">{{ $kontakPage->accent_text ?? 'Hubungi Kami' }}</p>
        </div>
    </section>

    <!-- Contact info cards -->
    <section class="page-section">
        <div class="page-inner">
            <div class="kontak-cards">
                @if ($kontak->alamat)
                    <div class="kontak-card">
                        <div class="kontak-card__icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </div>
                        <span class="kontak-card__label">Alamat</span>
                        <p class="kontak-card__value">{{ $kontak->alamat }}</p>
                        @if ($kontak->alamat_sub)
                            <p class="kontak-card__sub">{{ $kontak->alamat_sub }}</p>
                        @endif
                    </div>
                @endif

                @if ($kontak->telp)
                    <div class="kontak-card">
                        <div class="kontak-card__icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1C9.61 21 3 14.39 3 6c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.24 1.02l-2.2 2.2z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <span class="kontak-card__label">Telepon &amp; Fax</span>
                        <p class="kontak-card__value">
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $kontak->telp) }}"
                                class="kontak-card__link">{{ $kontak->telp }}</a>
                        </p>
                        @if ($kontak->telp_sub)
                            <p class="kontak-card__sub">
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $kontak->telp_sub) }}"
                                    class="kontak-card__link">{{ $kontak->telp_sub }}</a>
                                &mdash; Fax
                            </p>
                        @endif
                    </div>
                @endif

                @if ($kontak->email)
                    <div class="kontak-card">
                        <div class="kontak-card__icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                <rect x="2" y="4" width="20" height="16" rx="2" stroke="currentColor"
                                    stroke-width="1.5" />
                                <path d="M2 8l10 6 10-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span class="kontak-card__label">Email</span>
                        <p class="kontak-card__value">
                            <a href="mailto:{{ $kontak->email }}" class="kontak-card__link">{{ $kontak->email }}</a>
                        </p>
                        @if ($kontak->email_sub)
                            <p class="kontak-card__sub">{{ $kontak->email_sub }}</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Form + Info -->
    <section class="page-section page-section--alt">
        <div class="page-inner">
            @if (session('success'))
                <div
                    style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:14px 18px;border-radius:8px;margin-bottom:24px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="kontak-main">
                <!-- Contact Form -->
                <div class="kontak-form-wrap">
                    <h2 class="kontak-form-wrap__title">Kirim Pesan</h2>
                    <form class="kontak-form" action="{{ route('kontak.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="kontak-form__row">
                            <div class="kontak-form__group">
                                <label class="kontak-form__label" for="nama">Nama Lengkap</label>
                                <input class="kontak-form__input {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                                    type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                    placeholder="Nama Anda" required autocomplete="name" />
                                @error('nama')
                                    <p style="color:#dc2626;font-size:12px;margin-top:4px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="kontak-form__group">
                                <label class="kontak-form__label" for="email">Email</label>
                                <input class="kontak-form__input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="email@contoh.com" required autocomplete="email" />
                                @error('email')
                                    <p style="color:#dc2626;font-size:12px;margin-top:4px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="kontak-form__group">
                            <label class="kontak-form__label" for="telp">No. Telepon</label>
                            <input class="kontak-form__input" type="tel" id="telp" name="telp"
                                value="{{ old('telp') }}" placeholder="+62 8xx xxxx xxxx" autocomplete="tel" />
                        </div>
                        <div class="kontak-form__group">
                            <label class="kontak-form__label" for="pesan">Pesan</label>
                            <textarea class="kontak-form__input kontak-form__textarea {{ $errors->has('pesan') ? 'is-invalid' : '' }}"
                                id="pesan" name="pesan" rows="6" placeholder="Tuliskan pesan Anda di sini..." required>{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <p style="color:#dc2626;font-size:12px;margin-top:4px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="kontak-form__submit" type="submit">Kirim Pesan →</button>
                    </form>
                </div>

                <!-- Hours + Misa Sidebar -->
                <div class="kontak-sidebar">
                    <div class="kontak-cards-grid">
                        @if ($peta && ($peta->jam_senin_jumat || $peta->jam_sabtu || $peta->jam_minggu))
                            <div class="kontak-jp">
                                <div class="kontak-jp__head">
                                    <div class="kontak-jp__head-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"/>
                                            <polyline points="12 6 12 12 16 14"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="kontak-jp__title">Jam Pelayanan</h3>
                                        <span class="kontak-jp__sub">Sekretariat Paroki</span>
                                    </div>
                                    <span class="kontak-jp__open-badge">
                                        <span class="kontak-jp__open-dot"></span>
                                        Buka
                                    </span>
                                </div>
                                <ul class="kontak-jp__list">
                                    @if ($peta->jam_senin_jumat)
                                        <li class="kontak-jp__row">
                                            <span class="kontak-jp__day">Senin — Jumat</span>
                                            <span class="kontak-jp__sep"></span>
                                            <span class="kontak-jp__time">{{ $peta->jam_senin_jumat }}</span>
                                        </li>
                                    @endif
                                    @if ($peta->jam_sabtu)
                                        <li class="kontak-jp__row">
                                            <span class="kontak-jp__day">Sabtu</span>
                                            <span class="kontak-jp__sep"></span>
                                            <span class="kontak-jp__time">{{ $peta->jam_sabtu }}</span>
                                        </li>
                                    @endif
                                    @if ($peta->jam_minggu)
                                        <li class="kontak-jp__row">
                                            <span class="kontak-jp__day">Minggu</span>
                                            <span class="kontak-jp__sep"></span>
                                            <span class="kontak-jp__time">{{ $peta->jam_minggu }}</span>
                                        </li>
                                    @endif
                                </ul>
                                @if ($peta->catatan_pelayanan)
                                    <p class="kontak-jp__note">{{ $peta->catatan_pelayanan }}</p>
                                @endif
                            </div>
                        @endif
                    </div>

                    @if ($kontak->facebook_url || $kontak->instagram_url || $kontak->youtube_url)
                        <div class="kontak-follow">
                            <h3 class="kontak-follow__title">Ikuti Kami</h3>
                            <div class="kontak-follow__links">
                                @if ($kontak->facebook_url)
                                    <a href="{{ $kontak->facebook_url }}" class="kontak-follow__link" target="_blank"
                                        rel="noopener">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"
                                            aria-hidden="true">
                                            <path
                                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                        Facebook
                                    </a>
                                @endif
                                @if ($kontak->instagram_url)
                                    <a href="{{ $kontak->instagram_url }}" class="kontak-follow__link" target="_blank"
                                        rel="noopener">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"
                                            aria-hidden="true">
                                            <path
                                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                        </svg>
                                        Instagram
                                    </a>
                                @endif
                                @if ($kontak->youtube_url)
                                    <a href="{{ $kontak->youtube_url }}" class="kontak-follow__link" target="_blank"
                                        rel="noopener">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"
                                            aria-hidden="true">
                                            <path
                                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                        </svg>
                                        YouTube
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Map -->
    @if ($kontak->map_embed_src)
        <section class="kontak-map">
            <iframe src="{{ $kontak->map_embed_src }}" title="Lokasi Paroki Santo Yoseph Matraman" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        </section>
    @endif

    <style>
        /* ── Jam Pelayanan card ─────────────────────────── */
        .kontak-jp {
            background: rgba(42, 24, 14, 0.03);
            border: 1px solid rgba(42, 24, 14, 0.10);
            border-radius: 14px;
            padding: 20px 22px;
        }

        .kontak-jp__head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .kontak-jp__head-icon {
            width: 36px;
            height: 36px;
            background: rgba(42, 24, 14, 0.05);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(42, 24, 14, 0.35);
            flex-shrink: 0;
        }

        .kontak-jp__title {
            font-size: 16.5px;
            font-weight: 600;
            font-family: 'Cinzel', Georgia, serif;
            color: #2a180e;
            margin: 0 0 1px;
        }

        .kontak-jp__sub {
            font-size: 13px;
            color: rgba(255, 122, 20, 0.573) !important;
        }

        .kontak-jp__open-badge {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 10.5px;
            font-weight: 600;
            color: #2d6a4f;
            background: rgba(45, 106, 79, 0.08);
            border: 1px solid rgba(45, 106, 79, 0.25);
            border-radius: 20px;
            padding: 3px 10px;
            white-space: nowrap;
        }

        .kontak-jp__open-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #2d6a4f;
            flex-shrink: 0;
        }

        .kontak-jp__list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .kontak-jp__row {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(42, 24, 14, 0.08);
        }

        .kontak-jp__row:last-child { border-bottom: none; }

        .kontak-jp__day {
            font-size: 15px;
            color: rgba(42, 24, 14, 0.50);
            flex-shrink: 0;
            min-width: 110px;
        }

        .kontak-jp__sep {
            flex: 1;
            height: 1px;
            background: repeating-linear-gradient(
                to right,
                rgba(42, 24, 14, 0.10) 0, rgba(42, 24, 14, 0.10) 2px,
                transparent 2px, transparent 6px
            );
        }

        .kontak-jp__time {
            font-size: 12.5px;
            font-weight: 600;
            color: #2a180e;
            text-align: right;
            white-space: nowrap;
        }

        .kontak-jp__note {
            font-size: 14px;
            color: rgba(42, 24, 14, 0.40);
            line-height: 1.6;
            margin: 12px 0 0;
            padding-top: 10px;
            border-top: 1px solid rgba(42, 24, 14, 0.08);
        }

        /* ── Cards Grid (Jam Pelayanan only) ─────── */
        .kontak-cards-grid {
            display: block;
        }

        @media (max-width: 768px) {
            .kontak-cards-grid {
                display: block;
            }
        }

        /* ── Jadwal Misa card ─────────────────────────── */
        .kontak-misa {
            background: rgba(42, 24, 14, 0.03);
            border: 1px solid rgba(42, 24, 14, 0.10);
            border-radius: 14px;
            padding: 20px 22px;
        }

        .kontak-misa__head {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .kontak-misa__head-icon {
            width: 36px;
            height: 36px;
            background: rgba(42, 24, 14, 0.05);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(42, 24, 14, 0.35);
            flex-shrink: 0;
        }

        .kontak-misa__title {
            font-size: 13.5px;
            font-weight: 600;
            color: #2a180e;
            margin: 0;
        }

        .kontak-misa__day-group {
            margin-bottom: 12px;
        }

        .kontak-misa__day-label {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: rgba(42, 24, 14, 0.40);
            margin-bottom: 6px;
            display: block;
        }

        .kontak-misa__list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .kontak-misa__row {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 0;
            font-size: 15px;
        }

        .kontak-misa__jam {
            color: #2a180e;
            font-weight: 500;
            flex-shrink: 0;
            min-width: 50px;
        }

        .kontak-misa__tipe {
            color: rgba(42, 24, 14, 0.50);
            font-size: 13px;
        }

        .kontak-misa__cta {
            display: inline-block;
            margin-top: 10px;
            color: rgba(42, 24, 14, 0.70);
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: color 0.18s;
        }

        .kontak-misa__cta:hover {
            color: #2a180e;
        }
    </style>
@endsection
