@extends('Admin.Layouts.Admin')

@section('title', 'Edit Admin')
@section('page_title', 'Edit Admin')
@section('breadcrumb', 'Pengaturan / Admin / Edit')

@section('content')
    <form id="form-update-admin" action="{{ route('admin.admin-users.update', $admin) }}" method="POST"
        style="max-width:560px">
        @csrf
        @method('PUT')

        <div class="card" style="margin-bottom:20px">
            <div class="card__header"><span class="card__title">Informasi Akun</span></div>
            <div class="card__body">
                <div class="profile-grid">
                    <div class="form-group">
                        <label class="form-label" for="nama_depan">Nama Depan</label>
                        <input type="text" id="nama_depan" name="nama_depan"
                            class="form-control {{ $errors->has('nama_depan') ? 'is-invalid' : '' }}"
                            value="{{ old('nama_depan', $admin->nama_depan) }}" required autofocus>
                        @error('nama_depan')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="nama_belakang">Nama Belakang</label>
                        <input type="text" id="nama_belakang" name="nama_belakang"
                            class="form-control {{ $errors->has('nama_belakang') ? 'is-invalid' : '' }}"
                            value="{{ old('nama_belakang', $admin->nama_belakang) }}" required>
                        @error('nama_belakang')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" name="username"
                        class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                        value="{{ old('username', $admin->username) }}" required autocomplete="off">
                    @error('username')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password Baru
                        <span style="font-weight:400;color:var(--muted)">(kosongkan jika tidak diubah)</span>
                    </label>
                    <input type="password" id="password" name="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        autocomplete="new-password">
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        autocomplete="new-password">
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:20px">
            <div class="card__header"><span class="card__title">Role</span></div>
            <div class="card__body">
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Pilih Role (minimal 1)</label>
                    @php $adminRoleIds = old('roles', $admin->roles->pluck('id')->toArray()); @endphp
                    @if ($roles->isEmpty())
                        <p style="font-size:12px;color:var(--muted)">Belum ada role. <a
                                href="{{ route('admin.role-master.create') }}">Buat role terlebih dahulu</a>.</p>
                    @else
                        <div style="display:flex;flex-direction:column;gap:8px">
                            @foreach ($roles as $role)
                                <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                        {{ in_array($role->id, $adminRoleIds) ? 'checked' : '' }}
                                        style="width:16px;height:16px;flex-shrink:0;accent-color:var(--accent)">
                                    <span style="font-size:13px;font-weight:500">{{ $role->nama }}</span>
                                    @if ($role->deskripsi)
                                        <span
                                            style="font-size:11px;color:var(--muted)">— {{ $role->deskripsi }}</span>
                                    @endif
                                </label>
                            @endforeach
                        </div>
                    @endif
                    @error('roles')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.admin-users.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>

    @if ($admin->id !== auth('admin')->id())
        <div class="card" style="max-width:560px;margin-top:20px">
            <div class="card__body" style="padding:16px">
                <button type="button" class="btn btn-danger btn-full"
                    onclick="document.getElementById('modal-del').style.display='flex'">
                    Hapus Admin Ini
                </button>
            </div>
        </div>

        {{-- Delete Modal --}}
        <div id="modal-del"
            style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;backdrop-filter:blur(2px)">
            <div
                style="background:#ffffff;border:1px solid #e0e0e0;border-radius:var(--radius);padding:32px;width:100%;max-width:420px;margin:16px;color:#333;box-shadow:0 20px 40px rgba(0,0,0,0.2);animation:slideUp 0.3s ease">
                <h3 style="margin:0 0 8px;font-size:18px;font-weight:600;color:#333">Hapus Admin</h3>
                <p style="margin:0 0 24px;font-size:14px;color:#666;line-height:1.5">Apakah Anda yakin ingin menghapus admin
                    "<strong style="color:#333">{{ $admin->nama_lengkap }}</strong>"? Tindakan ini tidak dapat dibatalkan.</p>
                <div style="display:flex;gap:12px;justify-content:flex-end">
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('modal-del').style.display='none'" style="flex:1">Batal</button>
                    <form id="form-delete-admin" action="{{ route('admin.admin-users.destroy', $admin) }}" method="POST" style="flex:1">
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
    @endif
@endsection
