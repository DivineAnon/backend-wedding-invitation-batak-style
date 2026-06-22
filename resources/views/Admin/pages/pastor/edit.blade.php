@extends('Admin.Layouts.Admin')

@section('title', 'Edit Pastor')
@section('page_title', 'Edit Pastor')
@section('breadcrumb', 'Konten / Pastor / Edit')

@section('content')
    <form action="{{ route('admin.pastor.update', $pastor) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;">

            {{-- Left column —— main fields --}}
            <div>
                <div class="card" style="margin-bottom:20px;">
                    <div class="card__header">
                        <div class="card__title">Informasi Pastor</div>
                    </div>
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="nama">Nama Lengkap <span
                                    style="color:var(--danger)">*</span></label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $pastor->nama) }}"
                                class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" />
                            @error('nama')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="profile-grid">
                            <div class="form-group">
                                <label class="form-label" for="ordo">Ordo / Kongregasi</label>
                                <input type="text" name="ordo" id="ordo" value="{{ old('ordo', $pastor->ordo) }}"
                                    class="form-control" placeholder="cth. SVD, SJ, OFM" />
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="jabatan">Jabatan <span
                                        style="color:var(--danger)">*</span></label>
                                <input type="text" name="jabatan" id="jabatan"
                                    value="{{ old('jabatan', $pastor->jabatan) }}"
                                    class="form-control {{ $errors->has('jabatan') ? 'is-invalid' : '' }}" />
                                @error('jabatan')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="profile-grid">
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label" for="periode_mulai">Tahun Mulai</label>
                                <input type="text" name="periode_mulai" id="periode_mulai"
                                    value="{{ old('periode_mulai', $pastor->periode_mulai) }}" class="form-control" />
                            </div>
                            <div class="form-group" style="margin-bottom:0;">
                                <label class="form-label" for="periode_selesai">Tahun Selesai</label>
                                <input type="text" name="periode_selesai" id="periode_selesai"
                                    value="{{ old('periode_selesai', $pastor->periode_selesai) }}" class="form-control"
                                    placeholder="Kosongkan jika masih menjabat" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="card" style="margin-bottom:20px;">
                    <div class="card__header">
                        <div class="card__title">Biografi (opsional)</div>
                    </div>
                    <div class="card__body">
                        <div class="form-group" style="margin:0;">
                            <textarea name="bio" id="bio" class="form-control" rows="5">{{ old('bio', $pastor->bio) }}</textarea>
                        </div>
                    </div>
                </div> --}}

                <div style="display:flex;gap:10px;">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('admin.pastor.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>

            {{-- Right column —— foto + urutan --}}
            <div>
                <div class="card" style="margin-bottom:20px;">
                    <div class="card__header">
                        <div class="card__title">Urutan Tampil</div>
                    </div>
                    <div class="card__body">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label" for="urutan">Urutan</label>
                            <input type="number" name="urutan" id="urutan"
                                value="{{ old('urutan', $pastor->urutan) }}" class="form-control" min="0" />
                            <p style="font-size:11px;color:var(--muted);margin-top:4px;">Angka kecil tampil lebih dulu.</p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header">
                        <div class="card__title">Foto</div>
                    </div>
                    <div class="card__body">
                        @if ($pastor->foto)
                            <div style="margin-bottom:12px;">
                                <img id="img-preview" src="{{ media_url($pastor->foto, 'assets/pastor') }}"
                                    alt="{{ $pastor->nama }}" class="img-preview" />
                                <p style="font-size:11px;color:var(--muted);margin-top:4px;">Foto saat ini</p>
                            </div>
                        @else
                            <div id="img-preview-wrap" style="display:none;margin-bottom:12px;">
                                <img id="img-preview" src="" alt="" class="img-preview" />
                            </div>
                        @endif

                        <div class="form-group" style="margin:0;">
                            <label class="form-label" for="foto">
                                {{ $pastor->foto ? 'Ganti Foto (opsional)' : 'Upload Foto' }}
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
