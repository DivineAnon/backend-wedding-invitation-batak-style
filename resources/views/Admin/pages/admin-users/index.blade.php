@extends('Admin.Layouts.Admin')

@section('title', 'Manajemen Admin')
@section('page_title', 'Manajemen Admin')
@section('breadcrumb', 'Pengaturan / Admin')

@section('topbar_actions')
    <a href="{{ route('admin.admin-users.create') }}" class="btn btn-primary">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
        </svg>
        Tambah Admin
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card__header">
            <span class="card__title">Daftar Admin</span>
            <span style="font-size:12px;color:var(--muted)">{{ $admins->count() }} admin</span>
        </div>
        <div class="card__body" style="padding:0">
            @if ($admins->isEmpty())
                <div style="padding:40px;text-align:center;color:var(--muted)">Belum ada admin yang terdaftar.</div>
            @else
                <table class="table admin-table" id="tbl-admin-users" data-title="Admin">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Dibuat</th>
                            <th style="text-align:right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $i => $admin)
                            <tr>
                                <td style="color:var(--muted)">{{ $i + 1 }}</td>
                                <td style="font-weight:600">{{ $admin->nama_lengkap }}</td>
                                <td><code style="font-size:12px">{{ $admin->username }}</code></td>
                                <td>
                                    <div style="display:flex;flex-wrap:wrap;gap:4px">
                                        @forelse ($admin->roles as $role)
                                            <span class="badge">{{ $role->nama }}</span>
                                        @empty
                                            <span style="color:var(--muted);font-size:12px">—</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td style="font-size:12px;color:var(--muted);white-space:nowrap">
                                    {{ $admin->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td style="text-align:right">
                                    <div style="display:flex;gap:8px;justify-content:flex-end">
                                        <a href="{{ route('admin.admin-users.edit', $admin) }}" class="btn btn-secondary"
                                            style="padding:6px 12px;font-size:12px">Edit</a>
                                        <button type="button"
                                            onclick="openDelModal({{ $admin->id }}, '{{ addslashes($admin->nama_lengkap) }}')"
                                            class="btn btn-danger" style="padding:6px 12px;font-size:12px"
                                            {{ $admin->id === auth('admin')->id() ? 'disabled title="Tidak dapat menghapus akun sendiri"' : '' }}>
                                            Hapus
                                        </button>
                                        <form id="del-admin-{{ $admin->id }}"
                                            action="{{ route('admin.admin-users.destroy', $admin) }}" method="POST"
                                            style="display:none">
                                            @csrf @method('DELETE')
                                        </form>
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
            <h3 style="margin:0 0 8px;font-size:18px;font-weight:600;color:#333">Hapus Admin</h3>
            <p style="margin:0 0 24px;font-size:14px;color:#666;line-height:1.5">Apakah Anda yakin ingin menghapus admin
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
                document.getElementById('del-admin-' + id).submit();
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
