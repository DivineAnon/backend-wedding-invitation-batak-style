@extends('Admin.Layouts.Admin')

@section('title', 'Edit Konten Halaman Beranda')
@section('page_title', 'Edit Konten Halaman Beranda')
@section('breadcrumb', 'Konten / Hero Beranda / Edit Konten Halaman')

@section('content')
    <form action="{{ route('admin.beranda.page.update') }}" method="POST">
        @csrf
        @method('PUT')

        {{-- ── Jadwal Misa ──────────────────────────────────────────────── --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Seksi Jadwal Misa</div>
            </div>
            <div class="card__body">
                <div class="form-group">
                    <label class="form-label" for="jadwal_label">Label Seksi <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="jadwal_label" id="jadwal_label"
                        value="{{ old('jadwal_label', $page->jadwal_label) }}"
                        class="form-control {{ $errors->has('jadwal_label') ? 'is-invalid' : '' }}" />
                    @error('jadwal_label') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="jadwal_title">Judul Seksi <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="jadwal_title" id="jadwal_title"
                        value="{{ old('jadwal_title', $page->jadwal_title) }}"
                        class="form-control {{ $errors->has('jadwal_title') ? 'is-invalid' : '' }}" />
                    @error('jadwal_title') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- ── Sejarah ──────────────────────────────────────────────────── --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Seksi Sejarah</div>
            </div>
            <div class="card__body">
                <div class="form-group">
                    <label class="form-label" for="sejarah_label">Label Seksi <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="sejarah_label" id="sejarah_label"
                        value="{{ old('sejarah_label', $page->sejarah_label) }}"
                        class="form-control {{ $errors->has('sejarah_label') ? 'is-invalid' : '' }}" />
                    @error('sejarah_label') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="sejarah_body1">Paragraf 1 <span style="color:var(--danger)">*</span></label>
                    <textarea name="sejarah_body1" id="sejarah_body1" rows="3"
                        class="form-control {{ $errors->has('sejarah_body1') ? 'is-invalid' : '' }}">{{ old('sejarah_body1', $page->sejarah_body1) }}</textarea>
                    @error('sejarah_body1') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="sejarah_body2">Paragraf 2 <span style="color:var(--danger)">*</span></label>
                    <textarea name="sejarah_body2" id="sejarah_body2" rows="3"
                        class="form-control {{ $errors->has('sejarah_body2') ? 'is-invalid' : '' }}">{{ old('sejarah_body2', $page->sejarah_body2) }}</textarea>
                    @error('sejarah_body2') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="sejarah_quote">Kutipan / Quote <span style="color:var(--danger)">*</span></label>
                    <textarea name="sejarah_quote" id="sejarah_quote" rows="3"
                        class="form-control {{ $errors->has('sejarah_quote') ? 'is-invalid' : '' }}">{{ old('sejarah_quote', $page->sejarah_quote) }}</textarea>
                    @error('sejarah_quote') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="sejarah_button_text">Teks Tombol <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="sejarah_button_text" id="sejarah_button_text"
                        value="{{ old('sejarah_button_text', $page->sejarah_button_text) }}"
                        class="form-control {{ $errors->has('sejarah_button_text') ? 'is-invalid' : '' }}" />
                    @error('sejarah_button_text') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- ── Renungan ─────────────────────────────────────────────────── --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Seksi Renungan</div>
            </div>
            <div class="card__body">
                <div class="profile-grid">
                    <div class="form-group">
                        <label class="form-label" for="renungan_eyebrow">Eyebrow Text <span style="color:var(--danger)">*</span></label>
                        <input type="text" name="renungan_eyebrow" id="renungan_eyebrow"
                            value="{{ old('renungan_eyebrow', $page->renungan_eyebrow) }}"
                            class="form-control {{ $errors->has('renungan_eyebrow') ? 'is-invalid' : '' }}" />
                        @error('renungan_eyebrow') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="renungan_title">Judul <span style="color:var(--danger)">*</span></label>
                        <input type="text" name="renungan_title" id="renungan_title"
                            value="{{ old('renungan_title', $page->renungan_title) }}"
                            class="form-control {{ $errors->has('renungan_title') ? 'is-invalid' : '' }}" />
                        @error('renungan_title') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="renungan_sub">Sub-judul <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="renungan_sub" id="renungan_sub"
                        value="{{ old('renungan_sub', $page->renungan_sub) }}"
                        class="form-control {{ $errors->has('renungan_sub') ? 'is-invalid' : '' }}" />
                    @error('renungan_sub') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="renungan_cta">Teks Tombol CTA <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="renungan_cta" id="renungan_cta"
                        value="{{ old('renungan_cta', $page->renungan_cta) }}"
                        class="form-control {{ $errors->has('renungan_cta') ? 'is-invalid' : '' }}" />
                    @error('renungan_cta') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- ── Berita ───────────────────────────────────────────────────── --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Seksi Berita</div>
            </div>
            <div class="card__body">
                <div class="form-group">
                    <label class="form-label" for="berita_label">Label Seksi <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="berita_label" id="berita_label"
                        value="{{ old('berita_label', $page->berita_label) }}"
                        class="form-control {{ $errors->has('berita_label') ? 'is-invalid' : '' }}" />
                    @error('berita_label') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="berita_title">Judul Seksi <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="berita_title" id="berita_title"
                        value="{{ old('berita_title', $page->berita_title) }}"
                        class="form-control {{ $errors->has('berita_title') ? 'is-invalid' : '' }}" />
                    @error('berita_title') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="berita_cta">Teks Tombol CTA <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="berita_cta" id="berita_cta"
                        value="{{ old('berita_cta', $page->berita_cta) }}"
                        class="form-control {{ $errors->has('berita_cta') ? 'is-invalid' : '' }}" />
                    @error('berita_cta') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- ── Pengumuman ───────────────────────────────────────────────── --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Seksi Pengumuman</div>
            </div>
            <div class="card__body">
                <div class="form-group">
                    <label class="form-label" for="pengumuman_eyebrow">Eyebrow Text <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="pengumuman_eyebrow" id="pengumuman_eyebrow"
                        value="{{ old('pengumuman_eyebrow', $page->pengumuman_eyebrow) }}"
                        class="form-control {{ $errors->has('pengumuman_eyebrow') ? 'is-invalid' : '' }}" />
                    @error('pengumuman_eyebrow') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="pengumuman_title">Judul Seksi <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="pengumuman_title" id="pengumuman_title"
                        value="{{ old('pengumuman_title', $page->pengumuman_title) }}"
                        class="form-control {{ $errors->has('pengumuman_title') ? 'is-invalid' : '' }}" />
                    @error('pengumuman_title') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="pengumuman_cta">Teks Tombol CTA <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="pengumuman_cta" id="pengumuman_cta"
                        value="{{ old('pengumuman_cta', $page->pengumuman_cta) }}"
                        class="form-control {{ $errors->has('pengumuman_cta') ? 'is-invalid' : '' }}" />
                    @error('pengumuman_cta') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- ── Footer ───────────────────────────────────────────────────── --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Footer</div>
            </div>
            <div class="card__body">
                <div class="form-group">
                    <label class="form-label" for="footer_brand">Nama Gereja (Brand) <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="footer_brand" id="footer_brand"
                        value="{{ old('footer_brand', $page->footer_brand) }}"
                        class="form-control {{ $errors->has('footer_brand') ? 'is-invalid' : '' }}" />
                    @error('footer_brand') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="footer_tagline">Tagline Footer <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="footer_tagline" id="footer_tagline"
                        value="{{ old('footer_tagline', $page->footer_tagline) }}"
                        class="form-control {{ $errors->has('footer_tagline') ? 'is-invalid' : '' }}" />
                    @error('footer_tagline') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="footer_copyright">Teks Copyright <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="footer_copyright" id="footer_copyright"
                        value="{{ old('footer_copyright', $page->footer_copyright) }}"
                        class="form-control {{ $errors->has('footer_copyright') ? 'is-invalid' : '' }}" />
                    <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                        Akan ditampilkan sebagai: &copy; {{ date('Y') }} <em>[teks copyright]</em>.
                    </p>
                    @error('footer_copyright') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.beranda.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection
