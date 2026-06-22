@extends('Admin.Layouts.Admin')

@section('title', 'Jam Pelayanan')
@section('page_title', 'Jam Pelayanan')
@section('breadcrumb', 'Konten / Jam Pelayanan')

@section('topbar_actions')
    <a href="{{ route('admin.jam-pelayanan.edit') }}" class="btn btn-primary">Edit Jam Pelayanan</a>
@endsection

@section('content')

    @if (session('success'))
        <div class="alert-success" style="margin-bottom:24px;">{{ session('success') }}</div>
    @endif

    {{-- Info banner --}}
    <div class="jp-info-banner">
        <div class="jp-info-banner__icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <span>Data jam pelayanan ini tampil di halaman <strong>Peta Paroki</strong>, <strong>Kontak</strong>, dan <strong>Footer</strong> website.</span>
    </div>

    {{-- Schedule cards --}}
    <div class="jp-cards">
        <div class="jp-card jp-card--primary">
            <div class="jp-card__header">
                <div class="jp-card__icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </div>
                <span class="jp-card__badge">Hari Kerja</span>
            </div>
            <div class="jp-card__label">Senin — Jumat</div>
            <div class="jp-card__time">{{ $peta->jam_senin_jumat ?: '—' }}</div>
            @if (!$peta->jam_senin_jumat)
                <div class="jp-card__empty">Belum diatur</div>
            @endif
        </div>

        <div class="jp-card">
            <div class="jp-card__header">
                <div class="jp-card__icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </div>
                <span class="jp-card__badge jp-card__badge--alt">Sabtu</span>
            </div>
            <div class="jp-card__label">Sabtu</div>
            <div class="jp-card__time">{{ $peta->jam_sabtu ?: '—' }}</div>
            @if (!$peta->jam_sabtu)
                <div class="jp-card__empty">Belum diatur</div>
            @endif
        </div>

        <div class="jp-card">
            <div class="jp-card__header">
                <div class="jp-card__icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
                <span class="jp-card__badge jp-card__badge--sun">Minggu</span>
            </div>
            <div class="jp-card__label">Minggu</div>
            <div class="jp-card__time">{{ $peta->jam_minggu ?: '—' }}</div>
            @if (!$peta->jam_minggu)
                <div class="jp-card__empty">Belum diatur</div>
            @endif
        </div>
    </div>

    {{-- Catatan --}}
    <div class="jp-note-card">
        <div class="jp-note-card__header">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            <span>Catatan Pelayanan</span>
        </div>
        <p class="jp-note-card__text">
            {{ $peta->catatan_pelayanan ?: 'Belum ada catatan pelayanan yang ditambahkan.' }}
        </p>
    </div>

@endsection

@section('styles')
<style>
    /* ── Info banner ───────────────────────────────── */
    .jp-info-banner {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: color-mix(in srgb, var(--accent) 8%, transparent);
        border: 1px solid color-mix(in srgb, var(--accent) 20%, transparent);
        border-radius: var(--radius);
        padding: 12px 16px;
        font-size: 12.5px;
        color: var(--text);
        margin-bottom: 28px;
    }
    .jp-info-banner__icon {
        color: var(--accent);
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* ── Cards grid ────────────────────────────────── */
    .jp-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .jp-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 24px 28px 28px;
        position: relative;
        overflow: hidden;
        transition: box-shadow 0.2s;
    }

    .jp-card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,.08);
    }

    .jp-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        background: var(--border);
        border-radius: 0 0 12px 12px;
    }

    .jp-card--primary::after {
        background: var(--accent);
    }

    .jp-card__header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .jp-card__icon {
        width: 40px;
        height: 40px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
    }

    .jp-card--primary .jp-card__icon {
        background: color-mix(in srgb, var(--accent) 10%, transparent);
        border-color: color-mix(in srgb, var(--accent) 25%, transparent);
        color: var(--accent);
    }

    .jp-card__badge {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: var(--muted);
        background: var(--bg);
        border: 1px solid var(--border);
        padding: 3px 10px;
        border-radius: 20px;
    }

    .jp-card__badge--alt {
        color: #7c6bff;
        background: rgba(124, 107, 255, .08);
        border-color: rgba(124, 107, 255, .2);
    }

    .jp-card__badge--sun {
        color: #e9a84c;
        background: rgba(233, 168, 76, .1);
        border-color: rgba(233, 168, 76, .25);
    }

    .jp-card__label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 8px;
    }

    .jp-card__time {
        font-size: 26px;
        font-weight: 700;
        color: var(--text);
        line-height: 1.15;
        letter-spacing: -.01em;
    }

    .jp-card--primary .jp-card__time {
        color: var(--accent);
    }

    .jp-card__empty {
        font-size: 12px;
        color: var(--muted);
        font-style: italic;
        margin-top: 4px;
    }

    /* ── Note card ─────────────────────────────────── */
    .jp-note-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 20px 24px;
    }

    .jp-note-card__header {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .04em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 12px;
    }

    .jp-note-card__text {
        font-size: 13px;
        line-height: 1.75;
        color: var(--text);
        margin: 0;
    }

    /* ── Responsive ────────────────────────────────── */
    @media (max-width: 900px) {
        .jp-cards { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 560px) {
        .jp-cards { grid-template-columns: 1fr; }
        .jp-card__time { font-size: 22px; }
    }
</style>
@endsection
