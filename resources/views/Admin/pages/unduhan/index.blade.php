@extends('Admin.Layouts.Admin')

@section('title', 'Unduhan')
@section('page_title', 'Unduhan')
@section('breadcrumb', 'Konten / Unduhan')

@section('topbar_actions')
    <a href="{{ route('admin.unduhan.page.edit') }}" class="btn btn-secondary" title="Edit hero image halaman unduhan">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="1"></circle>
            <circle cx="19" cy="12" r="1"></circle>
            <circle cx="5" cy="12" r="1"></circle>
        </svg>
        Pengaturan Halaman
    </a>
    <a href="{{ route('admin.unduhan.create') }}" class="btn btn-primary">+ Tambah File</a>
@endsection

@section('content')
    <div class="card">
        <div class="card__header">
            <div class="card__title">Semua File Unduhan</div>
        </div>
        <div class="card__body" style="padding:0;">
            <table class="table admin-table" id="tbl-unduhan" data-title="Unduhan">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Format</th>
                        <th>Ukuran</th>
                        <th>Urutan</th>
                        <th style="width:110px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($unduhan as $item)
                        <tr>
                            <td>
                                <div style="font-weight:500;">{{ $item->judul }}</div>
                                @if ($item->deskripsi)
                                    <div style="font-size:12px;color:var(--muted);">{{ Str::limit($item->deskripsi, 80) }}
                                    </div>
                                @endif
                                <div style="font-size:11px;color:var(--muted);margin-top:2px;">{{ $item->original_name }}
                                </div>
                            </td>
                            <td style="font-size:12px;">
                                {{ \App\Models\Unduhan::KATEGORI[$item->kategori] ?? ucfirst($item->kategori) }}
                            </td>
                            <td>
                                <span
                                    style="background:{{ $item->format_color }};color:#fff;padding:2px 8px;border-radius:4px;font-size:11px;font-weight:600;">
                                    {{ $item->format_label }}
                                </span>
                            </td>
                            <td style="font-size:13px;">{{ $item->ukuran_format ?: '—' }}</td>
                            <td style="font-size:13px;">{{ $item->urutan }}</td>
                            <td style="text-align:right;">
                                <div style="display:flex;gap:6px;justify-content:flex-end;">
                                    <a href="{{ route('admin.unduhan.edit', $item) }}" class="btn btn-secondary"
                                        style="padding:4px 10px;font-size:12px;">Edit</a>
                                    <form id="del-form-{{ $item->id }}" action="{{ route('admin.unduhan.destroy', $item) }}" method="POST"
                                        style="display:none">
                                        @csrf @method('DELETE')
                                    </form>
                                    <button type="button" class="btn btn-danger"
                                        style="padding:4px 10px;font-size:12px;"
                                        onclick="openDelModal({{ $item->id }}, '{{ addslashes($item->judul) }}')">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:var(--muted);padding:32px;">
                                Belum ada file unduhan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div id="modal-del"
        style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;backdrop-filter:blur(2px)">
        <div
            style="background:#ffffff;border:1px solid #e0e0e0;border-radius:var(--radius);padding:32px;width:100%;max-width:420px;margin:16px;color:#333;box-shadow:0 20px 40px rgba(0,0,0,0.2);animation:slideUp 0.3s ease">
            <h3 style="margin:0 0 8px;font-size:18px;font-weight:600;color:#333">Hapus File Unduhan</h3>
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
