@extends('Admin.Layouts.Admin')

@section('title', 'Tambah Admin')
@section('page_title', 'Tambah Admin')
@section('breadcrumb', 'Pengaturan / Admin / Tambah')

@section('content')
    <form action="{{ route('admin.admin-users.store') }}" method="POST" style="max-width:560px">
        @csrf
        <div class="card" style="margin-bottom:20px">
            <div class="card__header"><span class="card__title">Informasi Akun</span></div>
            <div class="card__body">
                <div class="profile-grid">
                    <div class="form-group">
                        <label class="form-label" for="nama_depan">Nama Depan</label>
                        <input type="text" id="nama_depan" name="nama_depan"
                            class="form-control {{ $errors->has('nama_depan') ? 'is-invalid' : '' }}"
                            value="{{ old('nama_depan') }}" required autofocus>
                        @error('nama_depan')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="nama_belakang">Nama Belakang</label>
                        <input type="text" id="nama_belakang" name="nama_belakang"
                            class="form-control {{ $errors->has('nama_belakang') ? 'is-invalid' : '' }}"
                            value="{{ old('nama_belakang') }}" required>
                        @error('nama_belakang')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" name="username"
                        class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                        value="{{ old('username') }}" required autocomplete="off">
                    @error('username')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" required
                        autocomplete="new-password">
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        required autocomplete="new-password">
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:20px">
            <div class="card__header"><span class="card__title">Role</span></div>
            <div class="card__body">
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">Pilih Role (minimal 1)</label>
                    @if ($roles->isEmpty())
                        <p style="font-size:12px;color:var(--muted)">Belum ada role. <a
                                href="{{ route('admin.role-master.create') }}">Buat role terlebih dahulu</a>.</p>
                    @else
                        <div style="display:flex;flex-direction:column;gap:8px">
                            @foreach ($roles as $role)
                                <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                        {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}
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
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.admin-users.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
