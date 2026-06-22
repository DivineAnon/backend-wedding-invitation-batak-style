@extends('Admin.Layouts.Admin')

@section('title', 'Edit Anggota Dewan Paroki')
@section('page_title', 'Edit Anggota Dewan Paroki')
@section('breadcrumb', 'Konten / Dewan Paroki / Edit')

@section('content')
    <form action="{{ route('admin.dewan-paroki.update', $dewanParoki) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;">

            {{-- Left column --}}
            <div>
                <div class="card" style="margin-bottom:20px;">
                    <div class="card__header">
                        <div class="card__title">Informasi</div>
                    </div>
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="nama">Nama Lengkap <span
                                    style="color:var(--danger)">*</span></label>
                            <input type="text" name="nama" id="nama"
                                value="{{ old('nama', $dewanParoki->nama) }}"
                                class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" />
                            @error('nama')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" for="jabatan">Jabatan <span
                                    style="color:var(--danger)">*</span></label>
                            <input type="text" name="jabatan" id="jabatan"
                                value="{{ old('jabatan', $dewanParoki->jabatan) }}"
                                class="form-control {{ $errors->has('jabatan') ? 'is-invalid' : '' }}" />
                            @error('jabatan')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div style="display:flex;gap:10px;">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('admin.dewan-paroki.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>

            {{-- Right column --}}
            <div>
                <div class="card" style="margin-bottom:20px;">
                    <div class="card__header">
                        <div class="card__title">Urutan Tampil</div>
                    </div>
                    <div class="card__body">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label" for="urutan">Urutan</label>
                            <input type="number" name="urutan" id="urutan"
                                value="{{ old('urutan', $dewanParoki->urutan) }}" class="form-control" min="0" />
                            <p style="font-size:11px;color:var(--muted);margin-top:4px;">Angka kecil tampil lebih dulu.</p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header">
                        <div class="card__title">Foto</div>
                    </div>
                    <div class="card__body">
                        @if ($dewanParoki->foto)
                            <div style="margin-bottom:12px;">
                                <img id="img-preview"
                                    src="{{ media_url($dewanParoki->foto, 'assets/dewan-paroki') }}"
                                    alt="{{ $dewanParoki->nama }}" class="img-preview" />
                                <p style="font-size:11px;color:var(--muted);margin-top:4px;">Foto saat ini</p>
                            </div>
                        @else
                            <div id="img-preview-wrap" style="display:none;margin-bottom:12px;">
                                <img id="img-preview" src="" alt="" class="img-preview" />
                            </div>
                        @endif

                        <div class="form-group" style="margin:0;">
                            <label class="form-label" for="foto">
                                {{ $dewanParoki->foto ? 'Ganti Foto (opsional)' : 'Upload Foto' }}
                            </label>
                            <input type="file" name="foto" id="foto" accept="image/*"
                                class="form-control {{ $errors->has('foto') ? 'is-invalid' : '' }}"
                                onchange="previewImg(this)" />
                            @error('foto')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                            <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                                Format: JPG, JPEG, PNG, WEBP. Maks 2 MB. Kosongkan jika tidak ingin mengganti.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection

@section('scripts')
    <script>
        function previewImg(input) {
            if (input.files && input.files[0]) {
                const img = document.getElementById('img-preview');
                const wrap = document.getElementById('img-preview-wrap');
                img.src = URL.createObjectURL(input.files[0]);
                if (wrap) wrap.style.display = 'block';
            }
        }
    </script>
@endsection
