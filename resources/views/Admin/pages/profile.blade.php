@extends('Admin.Layouts.Admin')

@section('title', 'Profil Saya')
@section('page_title', 'Profil Saya')
@section('breadcrumb')
    Pengaturan / <span>Profil</span>
@endsection

@section('content')
    <form action="{{ route('admin.profile.update') }}" method="POST" style="max-width:600px;">
        @csrf
        @method('PUT')

        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Informasi Akun</div>
            </div>
            <div class="card__body">
                <div class="profile-grid">
                    <div class="form-group">
                        <label class="form-label" for="nama_depan">Nama Depan</label>
                        <input type="text" name="nama_depan" id="nama_depan"
                            value="{{ old('nama_depan', $admin->nama_depan) }}"
                            class="form-control {{ $errors->has('nama_depan') ? 'is-invalid' : '' }}" />
                        @error('nama_depan')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="nama_belakang">Nama Belakang</label>
                        <input type="text" name="nama_belakang" id="nama_belakang"
                            value="{{ old('nama_belakang', $admin->nama_belakang) }}"
                            class="form-control {{ $errors->has('nama_belakang') ? 'is-invalid' : '' }}" />
                        @error('nama_belakang')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $admin->username) }}"
                        autocomplete="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" />
                    @error('username')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:24px;">
            <div class="card__header">
                <div class="card__title">Ganti Password</div>
            </div>
            <div class="card__body">
                <p style="font-size:12px;color:var(--muted);margin-bottom:16px;">
                    Kosongkan jika tidak ingin mengganti password.
                </p>
                <div class="form-group">
                    <label class="form-label" for="password">Password Baru</label>
                    <input type="password" name="password" id="password" autocomplete="new-password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" />
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        autocomplete="new-password" class="form-control" />
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
@endsection
