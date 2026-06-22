@extends('Admin.Layouts.Admin')

@section('title', 'Tambah Anggota Dewan Paroki')
@section('page_title', 'Tambah Anggota Dewan Paroki')
@section('breadcrumb', 'Konten / Dewan Paroki / Tambah')

@section('content')
    <form action="{{ route('admin.dewan-paroki.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                                placeholder="cth. Yohanes Budi Santoso" />
                            @error('nama')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" for="jabatan">Jabatan <span
                                    style="color:var(--danger)">*</span></label>
                            <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}"
                                class="form-control {{ $errors->has('jabatan') ? 'is-invalid' : '' }}"
                                placeholder="cth. Ketua Dewan Paroki" />
                            @error('jabatan')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div style="display:flex;gap:10px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                            <input type="number" name="urutan" id="urutan" value="{{ old('urutan', 0) }}"
                                class="form-control" min="0" />
                            <p style="font-size:11px;color:var(--muted);margin-top:4px;">Angka kecil tampil lebih dulu.</p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header">
                        <div class="card__title">Foto <span style="color:var(--danger)">*</span></div>
                    </div>
                    <div class="card__body">
                        <div id="img-preview-wrap" style="display:none;margin-bottom:12px;">
                            <img id="img-preview" src="" alt="" class="img-preview" />
                        </div>
                        <div class="form-group" style="margin:0;">
                            <input type="file" name="foto" id="foto" accept="image/*"
                                class="form-control {{ $errors->has('foto') ? 'is-invalid' : '' }}"
                                onchange="previewImg(this)" required />
                            @error('foto')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                            <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                                Format: JPG, JPEG, PNG, WEBP. Maks 2 MB.
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
                document.getElementById('img-preview-wrap').style.display = 'block';
                document.getElementById('img-preview').src = URL.createObjectURL(input.files[0]);
            }
        }
    </script>
@endsection
