@extends('Admin.Layouts.Admin')

@section('title', 'Edit Kategori Berita')
@section('page_title', 'Edit Kategori')
@section('breadcrumb', 'Berita / Kategori / Edit')

@section('content')
    <div class="card" style="max-width:520px">
        <div class="card__header">
            <span class="card__title">Edit Kategori</span>
        </div>
        <div class="card__body">
            <form action="{{ route('admin.kategori-berita.update', $kategoriBerita) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label class="form-label" for="nama">Nama Kategori</label>
                    <input type="text" id="nama" name="nama"
                        class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                        value="{{ old('nama', $kategoriBerita->nama) }}" required autofocus>
                    @error('nama')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                    <div style="font-size:12px;color:var(--muted);margin-top:4px">
                        Slug akan diperbarui otomatis. Berita yang menggunakan kategori ini juga akan terupdate.
                    </div>
                </div>

                @if ($kategoriBerita->berita_count ?? $kategoriBerita->berita()->count() > 0)
                    <div class="alert alert-success" style="font-size:12px;margin-bottom:0;margin-top:4px">
                        Kategori ini digunakan oleh {{ $kategoriBerita->berita()->count() }} berita.
                        Perubahan nama akan otomatis terupdate ke semua berita tersebut.
                    </div>
                @endif

                <div style="display:flex;gap:8px;margin-top:24px">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('admin.kategori-berita.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
