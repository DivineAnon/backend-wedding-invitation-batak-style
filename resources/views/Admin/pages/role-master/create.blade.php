@extends('Admin.Layouts.Admin')

@section('title', 'Tambah Role')
@section('page_title', 'Tambah Role')
@section('breadcrumb', 'Pengaturan / Role Master / Tambah')

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
    <form action="{{ route('admin.role-master.store') }}" method="POST" style="max-width:900px">
        @csrf

        <div class="card" style="margin-bottom:20px">
            <div class="card__header"><span class="card__title">Informasi Role</span></div>
            <div class="card__body">
                <div class="form-group">
                    <label class="form-label" for="nama">Nama Role</label>
                    <input type="text" id="nama" name="nama"
                        class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" value="{{ old('nama') }}"
                        placeholder="mis. Editor, Moderator…" required autofocus>
                    @error('nama')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label" for="deskripsi">Deskripsi (opsional)</label>
                    <input type="text" id="deskripsi" name="deskripsi"
                        class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}"
                        value="{{ old('deskripsi') }}" placeholder="Deskripsi singkat tentang role ini…">
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
                                                {{ in_array($action, old('permissions.' . $slug, [])) ? 'checked' : '' }}>
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
            <button type="submit" class="btn btn-primary">Simpan Role</button>
            <a href="{{ route('admin.role-master.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
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
