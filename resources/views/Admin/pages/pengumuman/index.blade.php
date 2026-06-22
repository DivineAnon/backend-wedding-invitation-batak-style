@extends('Admin.Layouts.Admin')

@section('title', 'Pengumuman')
@section('page_title', 'Pengumuman')
@section('breadcrumb', 'Konten / Pengumuman')

@section('topbar_actions')
    <a href="{{ route('admin.pengumuman.page.edit') }}" class="btn btn-secondary" title="Edit hero image halaman pengumuman">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="1"></circle>
            <circle cx="19" cy="12" r="1"></circle>
            <circle cx="5" cy="12" r="1"></circle>
        </svg>
        Pengaturan Halaman
    </a>
    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
        </svg>
        Tambah Pengumuman
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card__header">
            <span class="card__title">Semua Pengumuman</span>
            <span style="font-size:12px;color:var(--muted)">{{ $pengumumans->count() }} pengumuman</span>
        </div>
        <div class="card__body" style="padding:0">
            @if ($pengumumans->isEmpty())
                <div style="padding:40px;text-align:center;color:var(--muted)">Belum ada pengumuman. Klik "Tambah
                    Pengumuman" untuk membuat yang pertama.</div>
            @else
                <table class="table admin-table" id="tbl-pengumuman" data-title="Pengumuman">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th style="text-align:center">Pin</th>
                            <th style="text-align:center">Status</th>
                            <th style="text-align:right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengumumans as $item)
                            <tr>
                                <td>
                                    <div style="font-weight:600;font-size:13px">{{ $item->judul }}</div>
                                    <div style="font-size:12px;color:var(--muted);margin-top:2px">
                                        {{ Str::limit($item->isi, 80) }}
                                    </div>
                                </td>
                                <td><span class="badge">{{ $item->kategori }}</span></td>
                                <td style="font-size:12px;color:var(--muted);white-space:nowrap">
                                    {{ $item->tanggal->translatedFormat('d M Y') }}
                                </td>
                                <td style="text-align:center">
                                    @if ($item->is_pinned)
                                        <span style="font-size:15px" title="Disematkan (Now)">📌</span>
                                    @else
                                        <span style="color:var(--muted)">—</span>
                                    @endif
                                </td>
                                <td style="text-align:center">
                                    @if ($item->is_active)
                                        <span class="status-badge status-badge--published">Aktif</span>
                                    @else
                                        <span class="status-badge status-badge--draft">Nonaktif</span>
                                    @endif
                                </td>
                                <td style="text-align:right">
                                    <div style="display:flex;gap:8px;justify-content:flex-end">
                                        <a href="{{ route('admin.pengumuman.edit', $item) }}" class="btn btn-secondary"
                                            style="padding:6px 12px;font-size:12px">Edit</a>
                                        <form id="del-form-{{ $item->id }}" action="{{ route('admin.pengumuman.destroy', $item) }}" method="POST"
                                            style="display:none">
                                            @csrf @method('DELETE')
                                        </form>
                                        <button type="button" class="btn btn-danger"
                                            style="padding:6px 12px;font-size:12px"
                                            {{ !auth('admin')->user()->hasPermission('pengumuman', 'delete') ? 'disabled' : '' }}
                                            title="{{ !auth('admin')->user()->hasPermission('pengumuman', 'delete') ? 'Anda tidak memiliki izin menghapus' : '' }}"
                                            onclick="openDelModal({{ $item->id }}, '{{ addslashes($item->judul) }}')">Hapus</button>
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
            <h3 style="margin:0 0 8px;font-size:18px;font-weight:600;color:#333">Hapus Pengumuman</h3>
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
