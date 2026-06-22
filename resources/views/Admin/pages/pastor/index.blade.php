@extends('Admin.Layouts.Admin')

@section('title', 'Pastor')
@section('page_title', 'Pastor')
@section('breadcrumb', 'Konten / Pastor')

@section('topbar_actions')
    <a href="{{ route('admin.pastor.page.edit') }}" class="btn btn-secondary" title="Edit hero image halaman Pastor">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="1"></circle>
            <circle cx="19" cy="12" r="1"></circle>
            <circle cx="5" cy="12" r="1"></circle>
        </svg>
        Pengaturan Halaman
    </a>
    <a href="{{ route('admin.pastor.create') }}" class="btn btn-primary">+ Tambah Pastor</a>
@endsection

@section('content')
    <div class="card">
        <div class="card__header">
            <div class="card__title">Semua Pastor</div>
        </div>
        <div class="card__body" style="padding:0;">
            <table class="table admin-table" id="tbl-pastor" data-title="Pastor">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Ordo</th>
                        <th>Jabatan</th>
                        <th>Periode</th>
                        <th>Urutan</th>
                        <th style="width:100px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pastors as $p)
                        <tr>
                            <td>
                                <img src="{{ media_url($p->foto, 'assets/pastor') }}" alt="{{ $p->nama }}"
                                    style="width:44px;height:52px;object-fit:cover;border-radius:4px;border:1px solid var(--border);" />
                            </td>
                            <td style="font-weight:500;">{{ $p->nama }}</td>
                            <td>{{ $p->ordo ?? '—' }}</td>
                            <td>{{ $p->jabatan }}</td>
                            <td style="font-size:12px;">
                                {{ $p->periode_mulai ?? '?' }}
                                {{ $p->periode_selesai ? '— ' . $p->periode_selesai : ($p->periode_mulai ? '— Sekarang' : '') }}
                            </td>
                            <td style="font-size:13px;">{{ $p->urutan }}</td>
                            <td style="text-align:right;">
                                <div style="display:flex;gap:6px;justify-content:flex-end;">
                                    <a href="{{ route('admin.pastor.edit', $p) }}" class="btn btn-secondary"
                                        style="padding:4px 10px;font-size:12px;">Edit</a>
                                    <form id="del-form-{{ $p->id }}" action="{{ route('admin.pastor.destroy', $p) }}" method="POST"
                                        style="display:none">
                                        @csrf @method('DELETE')
                                    </form>
                                    <button type="button" class="btn btn-danger"
                                        style="padding:4px 10px;font-size:12px;"
                                        onclick="openDelModal({{ $p->id }}, '{{ addslashes($p->nama) }}')">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;color:var(--muted);padding:32px;">
                                Belum ada data pastor.
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
            <h3 style="margin:0 0 8px;font-size:18px;font-weight:600;color:#333">Hapus Pastor</h3>
            <p style="margin:0 0 24px;font-size:14px;color:#666;line-height:1.5">Apakah Anda yakin ingin menghapus pastor
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
