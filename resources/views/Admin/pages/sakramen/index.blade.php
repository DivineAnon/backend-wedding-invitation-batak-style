@extends('Admin.Layouts.Admin')

@section('title', 'Pelayanan Sakramen')
@section('page_title', 'Pelayanan Sakramen')
@section('breadcrumb', 'Pelayanan / Sakramen')

@section('content')

    {{-- Intro --}}
    <div style="margin-bottom:24px;">
        <p style="font-size:13px;color:var(--muted);max-width:640px;line-height:1.7;">
            Kelola konten halaman pelayanan sakramen yang tampil di website. Setiap halaman dapat memiliki seksi,
            informasi kontak, dan file unduhan tersendiri.
        </p>
    </div>

    {{-- Card grid --}}
    <div class="sak-grid">
        @foreach ($sakramen as $i => $item)
            <div class="sak-card">
                <div class="sak-card__head">
                    <span class="sak-card__num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <a href="{{ route('admin.sakramen.edit', $item->slug) }}" class="sak-card__edit-ico" title="Edit">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                    </a>
                </div>
                <div class="sak-card__body">
                    <div class="sak-card__title">{{ $item->judul }}</div>
                    @if ($item->deskripsi)
                        <p class="sak-card__desc">{{ Str::limit($item->deskripsi, 90) }}</p>
                    @endif
                </div>
                <div class="sak-card__footer">
                    <div class="sak-card__tags">
                        <span class="sak-tag">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                                <line x1="16" y1="13" x2="8" y2="13" />
                                <line x1="16" y1="17" x2="8" y2="17" />
                                <polyline points="10 9 9 9 8 9" />
                            </svg>
                            {{ count($item->sections ?? []) }} seksi
                        </span>

                        @if ($item->kontak_nama || $item->kontak_telepon || $item->kontak_email)
                            <span class="sak-tag sak-tag--green">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.13 9.77a19.79 19.79 0 01-3.07-8.67A2 2 0 012.24 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.09a16 16 0 006 6l.56-.56a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 15.92z" />
                                </svg>
                                Kontak
                            </span>
                        @endif

                        @if (!empty($item->unduhan))
                            <span class="sak-tag sak-tag--blue">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                    <line x1="12" y1="15" x2="12" y2="3" />
                                </svg>
                                {{ count($item->unduhan) }} file
                            </span>
                        @endif
                    </div>
                    <a href="{{ route('admin.sakramen.edit', $item->slug) }}" class="btn btn-secondary"
                        style="font-size:12px;padding:5px 14px;">Edit →</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('styles')
<style>
    .sak-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(min(280px, 100%), 1fr));
        gap: 16px;
    }

    .sak-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.15s, border-color 0.15s;
    }

    .sak-card:hover {
        border-color: #d0ceca;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }

    .sak-card__head {
        padding: 16px 20px 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .sak-card__num {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        color: var(--muted);
        font-variant-numeric: tabular-nums;
    }

    .sak-card__edit-ico {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        color: var(--muted);
        background: transparent;
        transition: color 0.12s, background 0.12s;
    }

    .sak-card__edit-ico:hover {
        color: var(--accent);
        background: var(--bg);
    }

    .sak-card__body {
        padding: 12px 20px 16px;
        flex: 1;
    }

    .sak-card__title {
        font-size: 14px;
        font-weight: 600;
        color: var(--accent);
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .sak-card__desc {
        font-size: 12px;
        color: var(--muted);
        line-height: 1.6;
    }

    .sak-card__footer {
        padding: 12px 20px;
        border-top: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        flex-wrap: wrap;
    }

    .sak-card__tags {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .sak-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        font-weight: 500;
        padding: 2px 8px;
        border-radius: 100px;
        background: var(--bg);
        border: 1px solid var(--border);
        color: var(--muted);
    }

    .sak-tag--green {
        background: #f0fdf4;
        border-color: #bbf7d0;
        color: #16a34a;
    }

    .sak-tag--blue {
        background: #eff6ff;
        border-color: #bfdbfe;
        color: #2563eb;
    }
</style>
@endsection
