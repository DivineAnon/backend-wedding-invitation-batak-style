@extends('Admin.Layouts.Admin')

@section('title', 'Edit Halaman Dewan Paroki')
@section('page_title', 'Edit Halaman Dewan Paroki')
@section('breadcrumb', 'Konten / Dewan Paroki / Pengaturan Halaman')

@section('content')
    <form action="{{ route('admin.dewan-paroki.page.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="admin-form-grid">

            {{-- Main column --}}
            <div>
                <div class="card">
                    <div class="card__header">
                        <span class="card__title">Hero Image</span>
                        <span style="font-size:12px;color:var(--muted)">Gambar header untuk halaman Dewan Paroki</span>
                    </div>
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="hero_image">Hero Image (opsional)</label>
                            @if ($page->hero_image)
                                <div id="current-hero" style="margin-bottom:10px">
                                    <img src="{{ media_url($page->hero_image, 'assets/dewan-paroki') }}" alt="Hero image"
                                        style="max-width:100%;max-height:300px;border-radius:var(--radius);border:1px solid var(--border);object-fit:cover">
                                    <div style="margin-top:8px;font-size:12px;color:var(--muted)">
                                        File: <strong>{{ $page->hero_image }}</strong>
                                    </div>
                                </div>
                                <div style="margin-top:10px">
                                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                                        <input type="checkbox" name="hapus_hero" value="1" id="hapusHeroCheck" onchange="toggleHapusHero(this)">
                                        <span style="font-size:13px;color:var(--danger)">Hapus hero image (kembali ke tampilan default)</span>
                                    </label>
                                </div>
                            @else
                                <div style="padding:20px;background:var(--bg-secondary);border:2px dashed var(--border);border-radius:var(--radius);text-align:center;color:var(--muted)">
                                    <p style="margin:0;font-size:13px">Belum ada hero image</p>
                                </div>
                            @endif
                            <div style="margin-top:16px">
                                <input type="file" id="hero_image" name="hero_image" accept="image/jpg,image/jpeg,image/png,image/webp"
                                    class="form-control {{ $errors->has('hero_image') ? 'is-invalid' : '' }}"
                                    onchange="previewHeroImage(this)">
                                @error('hero_image')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="hero_image-preview" style="display:none;margin-top:16px">
                                <strong style="font-size:12px;color:var(--muted)">Preview:</strong>
                                <img id="hero_image-preview-img" src="" alt="Preview" style="max-width:100%;max-height:300px;border-radius:var(--radius);border:1px solid var(--border);margin-top:8px;object-fit:cover">
                            </div>
                            <p style="font-size:11px;color:var(--muted);margin-top:8px">
                                <strong>Format:</strong> JPG, PNG, WebP<br>
                                <strong>Ukuran maksimal:</strong> 5 MB<br>
                                <strong>Rekomendasi:</strong> 1920x600px atau lebih besar (aspect ratio 3:1)
                            </p>
                        </div>

                        <div class="form-group" style="margin-top:20px">
                            <label class="form-label" for="accent_text">Accent Text (teks hero kanan)</label>
                            <input type="text" name="accent_text" id="accent_text"
                                value="{{ old('accent_text', $page->accent_text) }}"
                                class="form-control {{ $errors->has('accent_text') ? 'is-invalid' : '' }}"
                                placeholder="Bersama melayani umat paroki">
                            @error('accent_text')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                            <p style="font-size:11px;color:var(--muted);margin-top:4px">Teks yang ditampilkan di sisi kanan hero. Kosongkan untuk menggunakan teks default.</p>
                        </div>

                        <div style="margin-top:24px;display:flex;gap:8px">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('admin.dewan-paroki.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div style="display:flex;flex-direction:column;gap:16px">
                <div class="card">
                    <div class="card__header"><span class="card__title">Informasi</span></div>
                    <div class="card__body" style="font-size:13px;color:var(--muted);line-height:1.6">
                        <p style="margin:0 0 12px">
                            <strong style="color:var(--text)">Hero Image</strong> adalah gambar header yang ditampilkan di bagian atas halaman Dewan Paroki di bagian public website.
                        </p>
                        <p style="margin:0 0 12px">
                            Gambar ini akan terlihat oleh semua pengunjung halaman Dewan Paroki.
                        </p>
                        <p style="margin:0">
                            <strong>⚠️ Catatan:</strong> Upload gambar baru akan menggantikan gambar lama secara otomatis.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection

@section('scripts')
    <script>
        function toggleHapusHero(cb) {
            const currentHero = document.getElementById('current-hero');
            const heroInput = document.getElementById('hero_image');
            if (cb.checked) {
                if (currentHero) { currentHero.style.opacity = '0.3'; currentHero.style.transition = 'opacity .2s'; }
                heroInput.disabled = true;
                heroInput.value = '';
                document.getElementById('hero_image-preview').style.display = 'none';
            } else {
                if (currentHero) currentHero.style.opacity = '1';
                heroInput.disabled = false;
            }
        }
        function previewHeroImage(input) {
            const hapusCheck = document.getElementById('hapusHeroCheck');
            if (hapusCheck && hapusCheck.checked) { hapusCheck.checked = false; toggleHapusHero(hapusCheck); }
            const preview = document.getElementById('hero_image-preview');
            const img = document.getElementById('hero_image-preview-img');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    img.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
