@extends('Admin.Layouts.Admin')

@section('title', 'Tambah Kategori Berita')
@section('page_title', 'Tambah Kategori')
@section('breadcrumb', 'Berita / Kategori / Tambah')

@section('content')
    <div class="card" style="max-width:520px">
        <div class="card__header">
            <span class="card__title">Kategori Baru</span>
        </div>
        <div class="card__body">
            <form action="{{ route('admin.kategori-berita.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="nama">Nama Kategori</label>
                    <input type="text" id="nama" name="nama"
                        class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" value="{{ old('nama') }}"
                        placeholder="contoh: Renungan" autofocus required>
                    @error('nama')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display:flex;gap:8px;margin-top:24px">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.kategori-berita.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
