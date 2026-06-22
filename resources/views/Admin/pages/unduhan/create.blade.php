@extends('Admin.Layouts.Admin')

@section('title', 'Tambah Unduhan')
@section('page_title', 'Tambah Unduhan')
@section('breadcrumb', 'Konten / Unduhan / Tambah')

@section('content')
    <form action="{{ route('admin.unduhan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;">

            {{-- Left --}}
            <div>
                <div class="card" style="margin-bottom:20px;">
                    <div class="card__header">
                        <div class="card__title">Informasi</div>
                    </div>
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="judul">Judul <span
                                    style="color:var(--danger)">*</span></label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                                class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}"
                                placeholder="cth. Formulir Data Umat" />
                            @error('judul')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="kategori">Kategori / Tab <span
                                    style="color:var(--danger)">*</span></label>
                            <select name="kategori" id="kategori"
                                class="form-control {{ $errors->has('kategori') ? 'is-invalid' : '' }}"
                                onchange="toggleKategori(this.value)">
                                <option value="dokumen" {{ old('kategori', 'dokumen') === 'dokumen' ? 'selected' : '' }}>
                                    Dokumen Biasa</option>
                                <option value="ebook" {{ old('kategori') === 'ebook' ? 'selected' : '' }}>Ebook</option>
                            </select>
                            @error('kategori')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" for="deskripsi">Deskripsi (opsional)</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Keterangan singkat...">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                </div>

                <div style="display:flex;gap:10px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.unduhan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>

            {{-- Right --}}
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
                            <p style="font-size:11px;color:var(--muted);margin-top:4px;">Angka kecil ditampilkan lebih dulu.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- File card (dokumen only) --}}
                <div class="card" id="card-file">
                    <div class="card__header">
                        <div class="card__title">File <span style="color:var(--danger)">*</span></div>
                    </div>
                    <div class="card__body">
                        <div class="form-group" style="margin:0;">
                            <input type="file" name="file" id="file"
                                class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}" />
                            @error('file')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                            <p style="font-size:11px;color:var(--muted);margin-top:6px;">
                                Format: PDF, DOC, DOCX, XLS, XLSX, CSV, PNG, JPG, JPEG, WEBP, GIF.<br>Maksimal 30 MB.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Link card (ebook only) --}}
                <div class="card" id="card-link" style="display:none;">
                    <div class="card__header">
                        <div class="card__title">Link Ebook <span style="color:var(--danger)">*</span></div>
                    </div>
                    <div class="card__body">
                        <div class="form-group" style="margin:0;">
                            <input type="url" name="link" id="link" value="{{ old('link') }}"
                                class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}"
                                placeholder="https://..." />
                            @error('link')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                            <p style="font-size:11px;color:var(--muted);margin-top:6px;">URL lengkap menuju halaman / file
                                ebook.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection

@section('scripts')
    <script>
        function toggleKategori(val) {
            var isEbook = val === 'ebook';
            document.getElementById('card-file').style.display = isEbook ? 'none' : '';
            document.getElementById('card-link').style.display = isEbook ? '' : 'none';
        }
        toggleKategori(document.getElementById('kategori').value);
    </script>
@endsection
