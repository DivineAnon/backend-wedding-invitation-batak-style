@php
    $footerPeta    = \App\Models\PetaParoki::first();
    $footerKontak  = \App\Models\Kontak::first();
    $footerBerandaPage = \App\Models\BerandaPage::first();
    $footerJadwals = \App\Models\JadwalMisa::orderBy('urutan')->get()->groupBy('hari_group');
    
    // Extract WhatsApp number (remove non-digits except +)
    $whatsappNo = $footerKontak?->whatsapp_no ? preg_replace('/[^0-9+]/', '', $footerKontak->whatsapp_no) : null;
    
    // Reorder groups: Senin-Jumat, Sabtu, Minggu, Jumat Pertama
    $groupOrder = ['Senin — Jumat', 'Sabtu', 'Minggu', 'Jumat Pertama'];
    $footerJadwals = collect($groupOrder)
        ->mapWithKeys(fn($group) => [$group => $footerJadwals->get($group)])
        ->filter();
@endphp
<style>
    /* ── Footer Misa Card ─────────────────────────────── */
    .footer-misa-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(201, 168, 97, 0.20);
        border-radius: 14px;
        padding: 20px 22px;
        width: 100%;
        max-width: 100%;
    }

    .footer-misa-card__header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .footer-misa-card__icon {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(250, 246, 238, 0.45);
        flex-shrink: 0;
    }

    .footer-misa-card__title {
        font-size: 16px;
        font-weight: 600;
        color: rgba(250, 246, 238, 0.88);
        margin: 0 0 2px;
    }

    .footer-misa-card__sub {
        font-size: 13.5px;
        color: rgba(250, 246, 238, 0.38);
    }

    .footer-misa-card__list {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .footer-misa-card__row {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 0;
        border-bottom: 1px solid rgba(250, 246, 238, 0.07);
    }

    .footer-misa-card__row:last-child { border-bottom: none; }

    .footer-misa-card__day {
        font-size: 14px;
        color: rgba(250, 246, 238, 0.48);
        flex-shrink: 0;
        min-width: 110px;
    }

    .footer-misa-card__sep {
        display: none;
    }

    .footer-misa-card__time {
        font-size: 15.5px;
        font-weight: 600;
        color: rgba(250, 246, 238, 0.85);
        text-align: right;
        white-space: nowrap;
    }

    /* Footer jam pelayanan card */
    .footer-jam-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(201, 168, 97, 0.20);
        border-radius: 14px;
        padding: 20px 22px;
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .footer-jam-card__header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .footer-jam-card__icon {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(250, 246, 238, 0.45);
        flex-shrink: 0;
    }

    .footer-jam-card__title {
        font-size: 14px;
        font-weight: 600;
        color: rgba(250, 246, 238, 0.88);
        margin: 0;
    }

    .footer-jam-card__list {
        display: flex;
        flex-direction: column;
        gap: 0;
        flex: 1;
    }

    .footer-jam-card__row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid rgba(250, 246, 238, 0.07);
        gap: 16px;
    }

    .footer-jam-card__row:last-child { border-bottom: none; }

    .footer-jam-card__label {
        font-size: 13.5px;
        color: rgba(250, 246, 238, 0.5);
        flex: 0 0 auto;
        white-space: nowrap;
    }

    .footer-jam-card__time {
        font-size: 15px;
        font-weight: 500;
        color: rgba(250, 246, 238, 0.88);
        text-align: right;
        flex: 0 0 auto;
        white-space: nowrap;
    }
    .footer-contact {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .footer-contact__item {
        display: flex;
        align-items: center;
        gap: 12px;
        color: rgba(250, 246, 238, 0.65);
        font-size: 16px;
        text-decoration: none;
        transition: color 0.18s;
    }

    .footer-contact__item:hover {
        color: rgba(250, 246, 238, 0.95);
    }

    .footer-contact__icon {
        width: 34px;
        height: 34px;
        background: rgba(250, 246, 238, 0.06);
        border: 1px solid rgba(250, 246, 238, 0.1);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(201, 168, 97, 0.8);
        flex-shrink: 0;
    }

    html.dark .footer-contact__icon {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        color: rgb(255, 122, 20);
    }

    /* ── Wrapper: 2 Cards Layout ─── */
    .footer-cards-wrapper {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 18px;
        width: 100%;
        align-items: start;
    }

    /* ── Info Container (Hubungi Kami + Jam Pelayanan) ─── */
    .footer-info-container {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(201, 168, 97, 0.20);
        border-radius: 14px;
        padding: 22px 24px;
        width: 100%;
        display: grid;
        grid-template-columns: 0.85fr 1.35fr;
        gap: 32px;
    }

    .footer-info-section {
        border-right: 1px solid rgba(250, 246, 238, 0.08);
        padding-right: 20px;
    }

    .footer-info-section:last-child {
        border-right: none;
        padding-right: 0;
    }

    .footer-info-section__title {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: rgb(255, 255, 255);
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 14px;
    }

    .footer-info-section__icon {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        opacity: 0.6;
    }

    .footer-info-section--contact .footer-contact {
        gap: 12px;
    }

    .footer-info-section--hours .footer-jam-card__row {
        padding: 8px 0;
    }

    /* Responsive: Tablet layout */
    @media (max-width: 1024px) {
        .footer-cards-wrapper {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .footer-info-container {
            grid-template-columns: 1fr;
            gap: 0;
            padding: 20px 22px;
        }

        .footer-info-section {
            border-right: none;
            border-bottom: 1px solid rgba(250, 246, 238, 0.08);
            padding-right: 0;
            padding-bottom: 20px;
        }

        .footer-info-section:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
    }

    /* Responsive: Mobile stacking */
    @media (max-width: 768px) {
        .footer-cards-wrapper {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .footer-info-container {
            grid-template-columns: 1fr;
            gap: 0;
            padding: 20px 18px;
        }

        .footer-info-section {
            border-right: none;
            border-bottom: 1px solid rgba(250, 246, 238, 0.08);
            padding-right: 0;
            padding-bottom: 16px;
        }

        .footer-info-section:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .footer-misa-card {
            padding: 20px 18px;
        }

        /* Keep jam row horizontal on mobile */
        .footer-jam-card__row {
            flex-wrap: nowrap;
            padding: 8px 0;
        }

        .footer-jam-card__label {
            font-size: 13px;
            min-width: 90px;
        }

        .footer-jam-card__time {
            font-size: 14px;
        }
    }

</style>
<footer class="footer">
    <div class="footer__inner">
        <div class="footer__top">
            <div class="footer__brand">
                <span class="footer__logo">{!! nl2br(e($footerBerandaPage?->footer_brand ?? 'Santo Yoseph Matraman')) !!}</span>
                <p class="footer__tagline">{!! nl2br(e($footerBerandaPage?->footer_tagline ?? 'Melayani dengan rendah hati dan cinta kasih.')) !!}</p>
                
                <div class="footer__social">
                    @if ($footerKontak?->facebook_url)
                    <a href="{{ $footerKontak->facebook_url }}" class="footer__social-link"
                        target="_blank" rel="noopener" aria-label="Facebook">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    @endif
                    @if ($footerKontak?->instagram_url)
                    <a href="{{ $footerKontak->instagram_url }}" class="footer__social-link" target="_blank"
                        rel="noopener" aria-label="Instagram">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    @endif
                    @if ($footerKontak?->youtube_url)
                    <a href="{{ $footerKontak->youtube_url }}"
                        class="footer__social-link" target="_blank" rel="noopener" aria-label="YouTube">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
            
            {{-- Unified Info Box (Hubungi Kami + Jam Pelayanan) | Jadwal Misa Card --}}
            <div class="footer-cards-wrapper">
                {{-- Left: Hubungi Kami + Jam Pelayanan --}}
                <div class="footer-info-container">
                    {{-- Section 1: Hubungi Kami --}}
                    <div class="footer-info-section footer-info-section--contact">
                        <div class="footer-info-section__title">
                            <svg class="footer-info-section__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.09 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .95h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                            </svg>
                            Hubungi Kami
                        </div>
                        <div class="footer-contact">
                            @if ($footerKontak?->telp)
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerKontak->telp) }}" class="footer-contact__item">
                                <span class="footer-contact__icon">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.09 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .95h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                                    </svg>
                                </span>
                                {{ $footerKontak->telp }}
                            </a>
                            @endif
                            @if ($footerKontak?->email)
                            <a href="mailto:{{ $footerKontak->email }}" class="footer-contact__item">
                                <span class="footer-contact__icon">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                        <polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                </span>
                                {{ $footerKontak->email }}
                            </a>
                            @endif
                            @if ($whatsappNo)
                            <a href="https://wa.me/{{ $whatsappNo }}" class="footer-contact__item" target="_blank" rel="noopener">
                                <span class="footer-contact__icon" style="background: rgba(37, 211, 102, 0.15); border-color: rgba(37, 211, 102, 0.3); color: #25D366;">
                                    <i class="fa fa-whatsapp" style="font-size: 14px;"></i>
                                </span>
                                {{ $footerKontak->whatsapp_no }}
                            </a>
                            @endif
                        </div>
                    </div>

                    {{-- Section 2: Jam Pelayanan --}}
                    <div class="footer-info-section footer-info-section--hours">
                        @if ($footerPeta)
                        <div class="footer-info-section__title">
                            <svg class="footer-info-section__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            Jam Pelayanan
                        </div>
                        <div class="footer-jam-card__list">
                            @if ($footerPeta->jam_senin_jumat)
                            <div class="footer-jam-card__row">
                                <span class="footer-jam-card__label">Senin - Jumat</span>
                                <span class="footer-jam-card__time">{{ $footerPeta->jam_senin_jumat }}</span>
                            </div>
                            @endif
                            @if ($footerPeta->jam_sabtu)
                            <div class="footer-jam-card__row">
                                <span class="footer-jam-card__label">Sabtu</span>
                                <span class="footer-jam-card__time">{{ $footerPeta->jam_sabtu }}</span>
                            </div>
                            @endif
                            @if ($footerPeta->jam_minggu)
                            <div class="footer-jam-card__row">
                                <span class="footer-jam-card__label">Minggu</span>
                                <span class="footer-jam-card__time">{{ $footerPeta->jam_minggu }}</span>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Right: Jadwal Misa Card (Separate) --}}
                <div class="footer-misa-card">
                    <div class="footer-misa-card__header">
                        <div class="footer-misa-card__icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="footer-misa-card__title">Jadwal Misa</h3>
                            <span class="footer-misa-card__sub">Setiap hari</span>
                        </div>
                    </div>
                    <div class="footer-misa-card__list">
                        @forelse ($footerJadwals as $hariGroup => $items)
                            <div class="footer-misa-card__row">
                                <span class="footer-misa-card__day">{{ $hariGroup }}</span>
                                <span class="footer-misa-card__sep"></span>
                                <span class="footer-misa-card__time">
                                    @foreach ($items->sortBy('urutan') as $j)
                                        {{ $j->jam }}@if (!$loop->last) | @endif
                                    @endforeach
                                </span>
                            </div>
                        @empty
                            <div class="footer-misa-card__row">
                                <span class="footer-misa-card__day">Harian</span>
                                <span class="footer-misa-card__sep"></span>
                                <span class="footer-misa-card__time">05.45</span>
                            </div>
                            <div class="footer-misa-card__row">
                                <span class="footer-misa-card__day">Sabtu</span>
                                <span class="footer-misa-card__sep"></span>
                                <span class="footer-misa-card__time">17.00</span>
                            </div>
                            <div class="footer-misa-card__row">
                                <span class="footer-misa-card__day">Minggu</span>
                                <span class="footer-misa-card__sep"></span>
                                <span class="footer-misa-card__time">06.30, 08.30, 18.00</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <span class="footer__copy">&copy; {{ date('Y') }} {{ $footerBerandaPage?->footer_copyright ?? 'Santo Yoseph Matraman' }}. Dibuat oleh <a
                    href="mailto:komsosmatraman@gmail.com" class="footer__copy-link">Komsos Matraman</a>.</span>
            {{-- <span class="footer__address">
                @if ($footerPeta?->telepon)
                    {{ $footerPeta->telepon }} &nbsp;&middot;&nbsp;
                @endif
                @if ($footerPeta?->email)
                    {{ $footerPeta->email }}
                @else
                    (021) 858-3782 &nbsp;&middot;&nbsp; info.sekre.sanyos@gmail.com
                @endif
            </span> --}}
        </div>
    </div>
</footer>
