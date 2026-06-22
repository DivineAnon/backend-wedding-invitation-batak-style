@extends('Admin.Layouts.Admin')

@section('title', 'Berita')
@section('page_title', 'Berita')
@section('breadcrumb', 'Konten / Berita')

@section('topbar_actions')
    <a href="{{ route('admin.berita.page.edit') }}" class="btn btn-secondary">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
        </svg>
        Pengaturan Halaman
    </a>
    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
        </svg>
        Tulis Berita
    </a>
@endsection

@section('content')
    {{-- Filter by kategori --}}
    <form method="GET" class="berita-filter-bar">
        <select name="kategori" class="form-control" style="width:auto;display:inline-block" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach ($kategoris as $kat)
                <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama }}
                </option>
            @endforeach
        </select>
        @if (request('kategori'))
            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary" style="font-size:12px">Reset</a>
        @endif
    </form>

    <div class="card" style="margin-top:16px">
        <div class="card__header">
            <span class="card__title">Semua Berita</span>
            <span style="font-size:12px;color:var(--muted)">{{ $beritas->count() }} berita</span>
        </div>
        <div class="card__body" style="padding:0">
            @if ($beritas->isEmpty())
                <div style="padding:40px;text-align:center;color:var(--muted)">Belum ada berita.</div>
            @else
                <table class="table admin-table" id="tbl-berita" data-title="Berita">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th style="text-align:right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beritas as $berita)
                            <tr>
                                <td>
                                    <div style="font-weight:600;font-size:13px">{{ $berita->judul }}</div>
                                    @if ($berita->ringkasan)
                                        <div style="font-size:12px;color:var(--muted);margin-top:2px">
                                            {{ Str::limit($berita->ringkasan, 80) }}</div>
                                    @endif
                                </td>
                                <td><span class="badge">{{ $berita->kategori->nama ?? '—' }}</span></td>
                                <td>
                                    @if ($berita->status === 'published')
                                        <span class="status-badge status-badge--published">Publish</span>
                                    @else
                                        <span class="status-badge status-badge--draft">Draft</span>
                                    @endif
                                </td>
                                <td style="font-size:12px;color:var(--muted);white-space:nowrap">
                                    {{ $berita->published_at ? $berita->published_at->translatedFormat('d M Y') : '—' }}
                                </td>
                                <td style="text-align:right">
                                    <div style="display:flex;gap:8px;justify-content:flex-end">
                                        <a href="{{ route('admin.berita.edit', $berita) }}" class="btn btn-secondary"
                                            style="padding:6px 12px;font-size:12px">Edit</a>
                                        <form id="del-form-{{ $berita->id }}" action="{{ route('admin.berita.destroy', $berita) }}" method="POST"
                                            style="display:none">
                                            @csrf @method('DELETE')
                                        </form>
                                        <button type="button" class="btn btn-danger"
                                            style="padding:6px 12px;font-size:12px"
                                            {{ !auth('admin')->user()->hasPermission('berita', 'delete') ? 'disabled' : '' }}
                                            title="{{ !auth('admin')->user()->hasPermission('berita', 'delete') ? 'Anda tidak memiliki izin menghapus' : '' }}"
                                            onclick="openDelModal({{ $berita->id }}, '{{ addslashes($berita->judul) }}')">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- Delete Modal --}}
    <div id="modal-del"
        style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;backdrop-filter:blur(2px)">
        <div
            style="background:#ffffff;border:1px solid #e0e0e0;border-radius:var(--radius);padding:32px;width:100%;max-width:420px;margin:16px;color:#333;box-shadow:0 20px 40px rgba(0,0,0,0.2);animation:slideUp 0.3s ease">
            <h3 style="margin:0 0 8px;font-size:18px;font-weight:600;color:#333">Hapus Berita</h3>
            <p style="margin:0 0 24px;font-size:14px;color:#666;line-height:1.5">Apakah Anda yakin ingin menghapus
                "<strong id="del-label" style="color:#333"></strong>"? Tindakan ini tidak dapat dibatalkan.</p>
            <div style="display:flex;gap:12px;justify-content:flex-end">
                <button type="button" class="btn btn-secondary" onclick="closeDelModal()" style="flex:1">Batal</button>
                <button type="button" class="btn btn-danger" id="del-confirm-btn" style="flex:1">Ya, Hapus</button>
            </div>
        </div>
    </div>
    <style>
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection

@section('scripts')
    <script>
        function openDelModal(id, label) {
            document.getElementById('del-label').textContent = label;
            document.getElementById('del-confirm-btn').onclick = function() {
                document.getElementById('del-form-' + id).submit();
            };
            document.getElementById('modal-del').style.display = 'flex';
        }
        function closeDelModal() {
            document.getElementById('modal-del').style.display = 'none';
        }
        document.getElementById('modal-del').addEventListener('click', function(e) {
            if (e.target === this) closeDelModal();
        });
    </script>
@endsection
