@extends('Admin.Layouts.Admin')

@section('title', 'Edit Role')
@section('page_title', 'Edit Role')
@section('breadcrumb', 'Pengaturan / Role Master / Edit')

@section('styles')
    <style>
        .perm-table {
            width: 100%;
            border-collapse: collapse;
        }

        .perm-table th,
        .perm-table td {
            padding: 10px 14px;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }

        .perm-table thead th {
            background: var(--bg);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--muted);
            font-weight: 600;
        }

        .perm-table tbody tr:hover {
            background: var(--bg);
        }

        .perm-table td:not(:first-child) {
            text-align: center;
        }

        .perm-table th:not(:first-child) {
            text-align: center;
        }

        .perm-check {
            width: 18px;
            height: 18px;
            accent-color: var(--accent);
            cursor: pointer;
        }

        .perm-page-label {
            font-weight: 500;
        }

        .perm-select-all {
            font-size: 11px;
            color: var(--accent);
            cursor: pointer;
            text-decoration: underline;
            background: none;
            border: none;
            padding: 0;
        }
    </style>
@endsection

@section('content')
    <form id="form-update-role" action="{{ route('admin.role-master.update', $role) }}" method="POST"
        style="max-width:900px">
        @csrf
        @method('PUT')

        <div class="card" style="margin-bottom:20px">
            <div class="card__header"><span class="card__title">Informasi Role</span></div>
            <div class="card__body">
                <div class="form-group">
                    <label class="form-label" for="nama">Nama Role</label>
                    <input type="text" id="nama" name="nama"
                        class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                        value="{{ old('nama', $role->nama) }}" required autofocus>
                    @error('nama')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label" for="deskripsi">Deskripsi (opsional)</label>
                    <input type="text" id="deskripsi" name="deskripsi"
                        class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}"
                        value="{{ old('deskripsi', $role->deskripsi) }}">
                    @error('deskripsi')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:20px">
            <div class="card__header">
                <span class="card__title">Permission</span>
                <div style="display:flex;gap:12px">
                    <button type="button" class="perm-select-all" onclick="toggleAllPermissions(true)">Pilih
                        Semua</button>
                    <button type="button" class="perm-select-all" onclick="toggleAllPermissions(false)">Hapus
                        Semua</button>
                </div>
            </div>
            <div class="card__body" style="padding:0">
                @php $currentPerms = old('permissions', $role->permissions ?? []); @endphp
                <table class="perm-table">
                    <thead>
                        <tr>
                            <th style="text-align:left">Halaman</th>
                            @foreach ($actionLabels as $action => $label)
                                <th>{{ $label }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $slug => $label)
                            <tr>
                                <td class="perm-page-label">{{ $label }}</td>
                                @foreach ($actionLabels as $action => $actionLabel)
                                    <td>
                                        @if (in_array($action, $pageActions[$slug]))
                                            <input type="checkbox" class="perm-check"
                                                name="permissions[{{ $slug }}][]" value="{{ $action }}"
                                                {{ in_array($action, $currentPerms[$slug] ?? []) ? 'checked' : '' }}>
                                        @else
                                            <span style="color:var(--muted)">—</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div style="display:flex;gap:10px">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.role-master.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>

    @if ($role->admins()->count() === 0)
        <div class="card" style="max-width:900px;margin-top:20px">
            <div class="card__body" style="padding:16px">
                <button type="button" class="btn btn-danger btn-full"
                    onclick="document.getElementById('modal-del').style.display='flex'">
                    Hapus Role Ini
                </button>
            </div>
        </div>

        {{-- Delete Modal --}}
        <div id="modal-del"
            style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;backdrop-filter:blur(2px)">
            <div
                style="background:#ffffff;border:1px solid #e0e0e0;border-radius:var(--radius);padding:32px;width:100%;max-width:420px;margin:16px;color:#333;box-shadow:0 20px 40px rgba(0,0,0,0.2);animation:slideUp 0.3s ease">
                <h3 style="margin:0 0 8px;font-size:18px;font-weight:600;color:#333">Hapus Role</h3>
                <p style="margin:0 0 24px;font-size:14px;color:#666;line-height:1.5">Apakah Anda yakin ingin menghapus role
                    "<strong style="color:#333">{{ $role->nama }}</strong>"? Tindakan ini tidak dapat dibatalkan.</p>
                <div style="display:flex;gap:12px;justify-content:flex-end">
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('modal-del').style.display='none'" style="flex:1">Batal</button>
                    <form id="form-delete-role" action="{{ route('admin.role-master.destroy', $role) }}" method="POST" style="flex:1">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width:100%">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        <style>
            @keyframes slideUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    @else
        <div class="card" style="max-width:900px;margin-top:20px">
            <div class="card__body" style="padding:16px;text-align:center">
                <p style="font-size:12px;color:var(--muted);margin:0">
                    Role ini tidak dapat dihapus karena masih digunakan oleh {{ $role->admins()->count() }} admin.
                </p>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        function toggleAllPermissions(checked) {
            document.querySelectorAll('.perm-check').forEach(function(cb) {
                cb.checked = checked;
            });
        }
    </script>
@endsection
