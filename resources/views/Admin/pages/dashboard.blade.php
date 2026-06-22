@extends('Admin.Layouts.Admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('breadcrumb', 'Selamat datang kembali')

@section('styles')
    <style>
        /* ─── Welcome banner ──────────────────────────────────────── */
        .dash-welcome {
            background: var(--accent);
            color: #fff;
            border-radius: var(--radius);
            padding: 26px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .dash-welcome__greeting {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .dash-welcome__sub {
            font-size: 13px;
            color: rgba(255, 255, 255, .5);
        }

        .dash-welcome__right {
            text-align: right;
        }

        .dash-welcome__date {
            font-size: 12px;
            color: rgba(255, 255, 255, .45);
            margin-bottom: 2px;
        }

        .dash-welcome__time {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -.01em;
            font-variant-numeric: tabular-nums;
            line-height: 1;
        }

        /* ─── Quick links ─────────────────────────────────────────── */
        .dash-quicklinks {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }

        .dash-quicklink {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-size: 12px;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
            transition: background .14s, border-color .14s, color .14s;
            white-space: nowrap;
        }

        .dash-quicklink:hover {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .dash-unread-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 16px;
            height: 16px;
            padding: 0 4px;
            background: #c0392b;
            color: #fff;
            border-radius: 99px;
            font-size: 9px;
            font-weight: 700;
        }

        /* ─── Stat cards ──────────────────────────────────────────── */
        .dash-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .dash-stat {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: box-shadow .14s;
        }

        .dash-stat:hover {
            box-shadow: 0 4px 18px rgba(0, 0, 0, .07);
        }

        .dash-stat__top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dash-stat__icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .dash-stat__badge {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .04em;
            padding: 2px 8px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .dash-stat__value {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -.02em;
            line-height: 1;
        }

        .dash-stat__label {
            font-size: 12px;
            color: var(--muted);
            font-weight: 500;
        }

        /* ─── 2-column section grids ──────────────────────────────── */
        .dash-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 16px;
            margin-bottom: 16px;
        }

        .dash-grid-bottom {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 900px) {

            .dash-grid,
            .dash-grid-bottom {
                grid-template-columns: 1fr;
            }
        }

        /* ─── Recent berita ───────────────────────────────────────── */
        .dash-berita-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 11px 0;
            border-bottom: 1px solid var(--border);
            text-decoration: none;
            color: inherit;
        }

        .dash-berita-item:last-child {
            border-bottom: none;
        }

        .dash-berita-item:hover .dash-berita-title {
            opacity: .65;
        }

        .dash-berita-thumb {
            width: 54px;
            height: 38px;
            border-radius: 5px;
            object-fit: cover;
            background: var(--bg);
            flex-shrink: 0;
        }

        .dash-berita-thumb--empty {
            width: 54px;
            height: 38px;
            border-radius: 5px;
            background: var(--bg);
            border: 1px solid var(--border);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--border);
        }

        .dash-berita-body {
            flex: 1;
            min-width: 0;
        }

        .dash-berita-title {
            font-size: 13px;
            font-weight: 600;
            line-height: 1.4;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 3px;
            transition: opacity .12s;
        }

        .dash-berita-meta {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: var(--muted);
            flex-wrap: wrap;
        }

        /* ─── Recent pengumuman ───────────────────────────────────── */
        .dash-pengumuman-item {
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
        }

        .dash-pengumuman-item:last-child {
            border-bottom: none;
        }

        .dash-pengumuman-title {
            font-size: 13px;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dash-pengumuman-meta {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: var(--muted);
        }

        /* ─── Activity feed ───────────────────────────────────────── */
        .dash-activity-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 9px 0;
            border-bottom: 1px solid var(--border);
        }

        .dash-activity-item:last-child {
            border-bottom: none;
        }

        .dash-activity-dot {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 700;
            flex-shrink: 0;
            color: #fff;
            margin-top: 2px;
        }

        .dash-activity-text {
            font-size: 12px;
            line-height: 1.5;
            flex: 1;
        }

        .dash-activity-time {
            font-size: 11px;
            color: var(--muted);
            margin-top: 2px;
        }

        /* ─── Content health bars ─────────────────────────────────── */
        .dash-health-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
        }

        .dash-health-item:last-child {
            border-bottom: none;
        }

        .dash-health-label {
            flex: 1;
            font-size: 12px;
            color: var(--muted);
            min-width: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dash-health-bar-wrap {
            width: 72px;
            height: 4px;
            background: var(--border);
            border-radius: 99px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .dash-health-bar {
            height: 100%;
            border-radius: 99px;
            transition: width .4s ease;
        }

        .dash-health-count {
            font-size: 13px;
            font-weight: 700;
            min-width: 24px;
            text-align: right;
            flex-shrink: 0;
        }

        /* ─── Pastor card inside summary ──────────────────────────── */
        .dash-pastor {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            background: var(--bg);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            margin-top: 16px;
        }

        .dash-pastor__avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border);
            flex-shrink: 0;
        }

        .dash-pastor__avatar-initial {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .dash-pastor__name {
            font-size: 13px;
            font-weight: 600;
        }

        .dash-pastor__role {
            font-size: 11px;
            color: var(--muted);
        }
    </style>
@endsection

@section('content')

    {{-- ── Welcome banner ── --}}
    <div class="dash-welcome">
        <div>
            <div class="dash-welcome__greeting">Halo, {{ auth('admin')->user()->nama_depan }} 👋</div>
            <div class="dash-welcome__sub">
                {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                &middot; Gereja Santo Yoseph, Paroki Matraman
            </div>
        </div>
        <div class="dash-welcome__right">
            <div class="dash-welcome__date">Waktu saat ini</div>
            <div class="dash-welcome__time" id="dashTime">--:--:--</div>
        </div>
    </div>

    {{-- ── Quick actions ── --}}
    <div class="dash-quicklinks">
        <a href="{{ route('admin.berita.create') }}" class="dash-quicklink">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Tulis Berita
        </a>
        <a href="{{ route('admin.pengumuman.create') }}" class="dash-quicklink">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Buat Pengumuman
        </a>
        <a href="{{ route('admin.unduhan.create') }}" class="dash-quicklink">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Upload Berkas
        </a>
        <a href="{{ route('admin.berita.index') }}" class="dash-quicklink">Semua Berita</a>
        <a href="{{ route('admin.pengumuman.index') }}" class="dash-quicklink">Semua Pengumuman</a>
        <a href="{{ route('admin.inbox.index') }}" class="dash-quicklink">
            Kotak Masuk
            @if ($stats['pesan_unread'] > 0)
                <span class="dash-unread-pill">{{ $stats['pesan_unread'] }}</span>
            @endif
        </a>
    </div>

    {{-- ── Stat cards ── --}}
    <div class="dash-stats">

        <div class="dash-stat">
            <div class="dash-stat__top">
                <div class="dash-stat__icon" style="background:#e8f5e9">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2e7d32" stroke-width="2">
                        <path d="M4 4h16v2H4zM4 10h16v2H4zM4 16h10v2H4z" />
                    </svg>
                </div>
                <span class="dash-stat__badge" style="background:#e8f5e9;color:#2e7d32">Terbit</span>
            </div>
            <div class="dash-stat__value">{{ $stats['berita_published'] }}</div>
            <div class="dash-stat__label">Berita Diterbitkan</div>
        </div>

        <div class="dash-stat">
            <div class="dash-stat__top">
                <div class="dash-stat__icon" style="background:#fff3e0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#e65100" stroke-width="2">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z" />
                    </svg>
                </div>
                <span class="dash-stat__badge" style="background:#fff3e0;color:#e65100">Draft</span>
            </div>
            <div class="dash-stat__value">{{ $stats['berita_draft'] }}</div>
            <div class="dash-stat__label">Berita Draft</div>
        </div>

        <div class="dash-stat">
            <div class="dash-stat__top">
                <div class="dash-stat__icon" style="background:#e3f2fd">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1565c0"
                        stroke-width="2">
                        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9" />
                        <path d="M13.73 21a2 2 0 01-3.46 0" />
                    </svg>
                </div>
                <span class="dash-stat__badge" style="background:#e3f2fd;color:#1565c0">Aktif</span>
            </div>
            <div class="dash-stat__value">{{ $stats['pengumuman_active'] }}</div>
            <div class="dash-stat__label">Pengumuman Aktif</div>
        </div>

        <div class="dash-stat">
            <div class="dash-stat__top">
                <div class="dash-stat__icon" style="background:#fce4ec">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c62828"
                        stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                </div>
                @if ($stats['pesan_unread'] > 0)
                    <span class="dash-stat__badge" style="background:#fce4ec;color:#c62828">{{ $stats['pesan_unread'] }}
                        Baru</span>
                @else
                    <span class="dash-stat__badge" style="background:#f5f5f5;color:var(--muted)">Terbaca</span>
                @endif
            </div>
            <div class="dash-stat__value">{{ $stats['pesan_total'] }}</div>
            <div class="dash-stat__label">Total Pesan Masuk</div>
        </div>

        <div class="dash-stat">
            <div class="dash-stat__top">
                <div class="dash-stat__icon" style="background:#ede7f6">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6d28d9"
                        stroke-width="2">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" y1="15" x2="12" y2="3" />
                    </svg>
                </div>
                <span class="dash-stat__badge" style="background:#ede7f6;color:#6d28d9">File</span>
            </div>
            <div class="dash-stat__value">{{ $stats['unduhan_total'] }}</div>
            <div class="dash-stat__label">Berkas Unduhan</div>
        </div>

        <div class="dash-stat">
            <div class="dash-stat__top">
                <div class="dash-stat__icon" style="background:#f5f4f1">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1a1a1a"
                        stroke-width="2">
                        <path
                            d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                </div>
                <span class="dash-stat__badge" style="background:#f5f4f1;color:var(--muted)">Admin</span>
            </div>
            @php $adminCount = \App\Models\Admin::count(); @endphp
            <div class="dash-stat__value">{{ $adminCount }}</div>
            <div class="dash-stat__label">Pengguna Admin</div>
        </div>

    </div>

    {{-- ── Main 2-col grid: Berita + Pengumuman ── --}}
    <div class="dash-grid">

        {{-- Berita terbaru --}}
        <div class="card">
            <div class="card__header">
                <div class="card__title">Berita Terbaru</div>
                <a href="{{ route('admin.berita.index') }}" style="font-size:12px;color:var(--muted)">Lihat semua →</a>
            </div>
            <div class="card__body" style="padding:6px 24px 16px">
                @forelse ($recentBerita as $b)
                    <a href="{{ route('admin.berita.edit', $b) }}" class="dash-berita-item">
                        @if ($b->gambar)
                            <img src="{{ media_url($b->gambar, 'assets/berita') }}" alt=""
                                class="dash-berita-thumb">
                        @else
                            <div class="dash-berita-thumb--empty">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <polyline points="21 15 16 10 5 21" />
                                </svg>
                            </div>
                        @endif
                        <div class="dash-berita-body">
                            <div class="dash-berita-title">{{ $b->judul }}</div>
                            <div class="dash-berita-meta">
                                @if ($b->kategori)
                                    <span>{{ $b->kategori->nama }}</span>
                                    <span>·</span>
                                @endif
                                <span
                                    style="color:{{ $b->status === 'published' ? '#2e7d32' : '#e65100' }};font-weight:600">
                                    {{ $b->status === 'published' ? 'Terbit' : 'Draft' }}
                                </span>
                                <span>·</span>
                                <span>{{ $b->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <p style="color:var(--muted);font-size:13px;padding:12px 0">Belum ada berita.</p>
                @endforelse
            </div>
        </div>

        {{-- Pengumuman terbaru --}}
        <div class="card">
            <div class="card__header">
                <div class="card__title">Pengumuman</div>
                <a href="{{ route('admin.pengumuman.index') }}" style="font-size:12px;color:var(--muted)">Lihat semua
                    →</a>
            </div>
            <div class="card__body" style="padding:6px 24px 16px">
                @forelse ($recentPengumuman as $p)
                    <div class="dash-pengumuman-item">
                        <div class="dash-pengumuman-title" title="{{ $p->judul }}">
                            @if ($p->is_pinned)
                                <svg width="9" height="9" viewBox="0 0 24 24" fill="#e65100"
                                    style="margin-right:4px;vertical-align:middle">
                                    <path
                                        d="M12 2l3.09 6.26 6.91 1-5 4.87 1.18 6.87L12 17.77l-6.18 3.23 1.18-6.87L2 9.26l6.91-1L12 2z" />
                                </svg>
                            @endif
                            {{ $p->judul }}
                        </div>
                        <div class="dash-pengumuman-meta">
                            <span
                                style="color:{{ $p->is_active ? '#2e7d32' : 'var(--muted)' }};font-weight:700;font-size:10px;text-transform:uppercase">
                                {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                            <span>·</span>
                            <span>{{ $p->kategori }}</span>
                            <span>·</span>
                            <span>{{ $p->tanggal?->format('d M Y') }}</span>
                        </div>
                    </div>
                @empty
                    <p style="color:var(--muted);font-size:13px;padding:12px 0">Belum ada pengumuman.</p>
                @endforelse
            </div>
        </div>

    </div>

    {{-- ── Bottom 2-col: Activity + Content summary ── --}}
    <div class="dash-grid-bottom">

        {{-- Aktivitas terbaru --}}
        <div class="card">
            <div class="card__header">
                <div class="card__title">Aktivitas Terbaru</div>
                <a href="{{ route('admin.activity-log.index') }}" style="font-size:12px;color:var(--muted)">Lihat semua
                    →</a>
            </div>
            <div class="card__body" style="padding:6px 24px 16px">
                @forelse ($recentLogs as $log)
                    @php
                        $aColor = \App\Models\ActivityLog::ACTION_COLORS[$log->action] ?? '#6b7280';
                        $aLabels = [
                            'created' => 'Tambah',
                            'updated' => 'Ubah',
                            'deleted' => 'Hapus',
                            'login' => 'Login',
                            'logout' => 'Logout',
                            'uploaded' => 'Upload',
                            'download' => 'Unduh',
                            'read' => 'Baca',
                            'unread' => 'Tandai',
                        ];
                        $aLabel = $aLabels[$log->action] ?? ucfirst($log->action);
                        $initials = strtoupper(substr($log->admin_name ?? '?', 0, 2));
                    @endphp
                    <div class="dash-activity-item">
                        <div class="dash-activity-dot" style="background:{{ $aColor }}">{{ $initials }}</div>
                        <div style="flex:1;min-width:0">
                            <div class="dash-activity-text">
                                <strong>{{ $log->admin_name }}</strong>
                                <span style="color:{{ $aColor }};font-weight:600"> {{ $aLabel }}</span>
                                {{ $log->module }}{{ $log->target_label ? ' — ' . $log->target_label : '' }}
                            </div>
                            <div class="dash-activity-time">{{ $log->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @empty
                    <p style="color:var(--muted);font-size:13px;padding:12px 0">Belum ada aktivitas.</p>
                @endforelse
            </div>
        </div>

        {{-- Ringkasan konten --}}
        <div class="card">
            <div class="card__header">
                <div class="card__title">Ringkasan Konten</div>
                <span style="font-size:12px;color:var(--muted)">{{ $stats['log_today'] }} aktivitas hari ini</span>
            </div>
            <div class="card__body" style="padding:8px 24px 16px">

                @php
                    $healthItems = [
                        [
                            'label' => 'Berita Terbit',
                            'val' => $stats['berita_published'],
                            'max' => max($stats['berita_total'], 1),
                            'color' => '#2e7d32',
                        ],
                        [
                            'label' => 'Berita Draft',
                            'val' => $stats['berita_draft'],
                            'max' => max($stats['berita_total'], 1),
                            'color' => '#e65100',
                        ],
                        [
                            'label' => 'Pengumuman Aktif',
                            'val' => $stats['pengumuman_active'],
                            'max' => max($stats['pengumuman_total'], 1),
                            'color' => '#1565c0',
                        ],
                        [
                            'label' => 'Pengumuman Pinned',
                            'val' => $stats['pengumuman_pinned'],
                            'max' => max($stats['pengumuman_total'], 1),
                            'color' => '#6d28d9',
                        ],
                        [
                            'label' => 'Pesan Terbaca',
                            'val' => $stats['pesan_total'] - $stats['pesan_unread'],
                            'max' => max($stats['pesan_total'], 1),
                            'color' => '#0d9488',
                        ],
                        [
                            'label' => 'Pesan Belum Dibaca',
                            'val' => $stats['pesan_unread'],
                            'max' => max($stats['pesan_total'], 1),
                            'color' => '#c62828',
                        ],
                        [
                            'label' => 'Berkas Unduhan',
                            'val' => $stats['unduhan_total'],
                            'max' => max($stats['unduhan_total'], 1),
                            'color' => '#6d28d9',
                        ],
                    ];
                @endphp

                @foreach ($healthItems as $item)
                    <div class="dash-health-item">
                        <span class="dash-health-label">{{ $item['label'] }}</span>
                        <div class="dash-health-bar-wrap">
                            <div class="dash-health-bar"
                                style="width:{{ $item['max'] > 0 ? round(min($item['val'] / $item['max'], 1) * 100) : 0 }}%;background:{{ $item['color'] }}">
                            </div>
                        </div>
                        <span class="dash-health-count" style="color:{{ $item['color'] }}">{{ $item['val'] }}</span>
                    </div>
                @endforeach

                @if ($pastor)
                    <div class="dash-pastor">
                        @if ($pastor->foto)
                            <img src="{{ media_url($pastor->foto, 'assets/pastor') }}" alt=""
                                class="dash-pastor__avatar">
                        @else
                            <div class="dash-pastor__avatar-initial">{{ strtoupper(substr($pastor->nama, 0, 1)) }}</div>
                        @endif
                        <div>
                            <div class="dash-pastor__name">{{ $pastor->nama }}</div>
                            <div class="dash-pastor__role">
                                {{ $pastor->jabatan }}{{ $pastor->ordo ? ' · ' . $pastor->ordo : '' }}</div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        (function() {
            function pad(n) {
                return n < 10 ? '0' + n : n;
            }

            function tick() {
                const n = new Date();
                const el = document.getElementById('dashTime');
                if (el) el.textContent = pad(n.getHours()) + ':' + pad(n.getMinutes()) + ':' + pad(n.getSeconds());
            }
            tick();
            setInterval(tick, 1000);
        }());
    </script>
@endsection
