@extends('Admin.Layouts.Admin')

@section('title', 'Kategori Berita')
@section('page_title', 'Kategori Berita')
@section('breadcrumb', 'Berita / Kategori')

@section('topbar_actions')
    <a href="{{ route('admin.kategori-berita.create') }}" class="btn btn-primary">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
        </svg>
        Tambah Kategori
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card__header">
            <span class="card__title">Semua Kategori</span>
            <span style="font-size:12px;color:var(--muted)">{{ $kategoris->count() }} kategori</span>
        </div>
        <div class="card__body" style="padding:0">
            @if ($kategoris->isEmpty())
                <div style="padding:40px;text-align:center;color:var(--muted)">Belum ada kategori. Tambahkan kategori
                    pertama.</div>
            @else
                <table class="table admin-table" id="tbl-kategori-berita" data-title="Kategori Berita">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th style="text-align:center">Jumlah Berita</th>
                            <th style="text-align:right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoris as $kategori)
                            <tr>
                                <td><strong>{{ $kategori->nama }}</strong></td>
                                <td><code style="font-size:12px;color:var(--muted)">{{ $kategori->slug }}</code></td>
                                <td style="text-align:center">
                                    <span class="badge">{{ $kategori->berita_count }}</span>
                                </td>
                                <td style="text-align:right">
                                    <div style="display:flex;gap:8px;justify-content:flex-end">
                                        <a href="{{ route('admin.kategori-berita.edit', $kategori) }}"
                                            class="btn btn-secondary" style="padding:6px 12px;font-size:12px">Edit</a>
                                        <form id="del-form-{{ $kategori->id }}" action="{{ route('admin.kategori-berita.destroy', $kategori) }}"
                                            method="POST" style="display:none">
                                            @csrf @method('DELETE')
                                        </form>
                                        <button type="button" class="btn btn-danger"
                                            style="padding:6px 12px;font-size:12px"
                                            {{ $kategori->berita_count > 0 ? 'disabled title=Tidak dapat dihapus karena masih ada berita' : '' }}
                                            onclick="openDelModal({{ $kategori->id }}, '{{ addslashes($kategori->nama) }}')">
                                            Hapus
                                        </button>
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
            <h3 style="margin:0 0 8px;font-size:18px;font-weight:600;color:#333">Hapus Kategori</h3>
            <p style="margin:0 0 24px;font-size:14px;color:#666;line-height:1.5">Apakah Anda yakin ingin menghapus kategori
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
