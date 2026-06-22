@extends('Admin.Layouts.Admin')

@section('title', 'Edit Peta Paroki')
@section('page_title', 'Edit Peta Paroki')
@section('breadcrumb', 'Konten / Peta Paroki / Edit')

@section('content')
    <form action="{{ route('admin.peta-paroki.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Hero Image --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Hero Image</div>
            </div>
            <div class="card__body">
                <div class="form-group" style="margin:0;margin-bottom:12px;">
                    <label class="form-label">Upload Gambar</label>
                    <input type="file" name="hero_image" id="hero_image" accept="image/jpeg,image/png,image/webp" 
                        class="form-control {{ $errors->has('hero_image') ? 'is-invalid' : '' }}" />
                    <p style="font-size:12px;color:var(--muted);margin-top:8px;">
                        Format: JPG, PNG, WebP | Max: 5MB
                    </p>
                    @error('hero_image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                @if ($peta->hero_image)
                    <div style="margin-top:16px;">
                        <p style="font-size:12px;color:var(--muted);margin-bottom:8px;">Preview Gambar:</p>
                        <img id="heroPreview" src="{{ media_url($peta->hero_image, 'assets/peta-paroki') }}" alt="Hero"
                            style="width:260px;height:140px;object-fit:cover;border-radius:6px;border:1px solid var(--border);" />
                        <div style="margin-top:10px">
                            <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                                <input type="checkbox" name="hapus_hero" value="1" id="hapusHeroCheck" onchange="toggleHapusHero(this)">
                                <span style="font-size:13px;color:var(--danger)">Hapus hero image (kembali ke tampilan default)</span>
                            </label>
                        </div>
                    </div>
                @endif
                <div class="form-group" style="margin-top:16px;">
                    <label class="form-label" for="accent_text">Accent Text (teks hero kanan)</label>
                    <input type="text" name="accent_text" id="accent_text"
                        value="{{ old('accent_text', $peta->accent_text) }}"
                        class="form-control {{ $errors->has('accent_text') ? 'is-invalid' : '' }}"
                        placeholder="Alamat paroki...">
                    @error('accent_text')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                    <p style="font-size:11px;color:var(--muted);margin-top:4px;">Teks yang ditampilkan di sisi kanan hero. Kosongkan untuk menggunakan alamat paroki secara otomatis.</p>
                </div>
            </div>
        </div>

        {{-- Info: jam pelayanan moved --}}
        <div style="display:flex;align-items:flex-start;gap:10px;background:color-mix(in srgb,var(--accent) 8%,transparent);border:1px solid color-mix(in srgb,var(--accent) 20%,transparent);border-radius:var(--radius);padding:12px 16px;font-size:12.5px;color:var(--text);margin-bottom:24px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--accent);flex-shrink:0;margin-top:1px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span>Untuk mengatur jam pelayanan sekretariat, gunakan menu <a href="{{ route('admin.jam-pelayanan.index') }}" style="color:var(--accent);font-weight:600;">Jam Pelayanan</a> di bawah Konten.</span>
        </div>

        {{-- Gambar --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Gambar Peta</div>
            </div>
            <div class="card__body">
                @if ($peta->gambar)
                    <img id="petaPreview" src="{{ media_url($peta->gambar, 'compro_assets/image') }}" alt="Peta"
                        class="img-preview" style="margin-bottom:12px;" />
                @else
                    <img id="petaPreview" src="" alt="" class="img-preview"
                        style="display:none;margin-bottom:12px;" />
                @endif
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="gambar">
                        {{ $peta->gambar ? 'Ganti Gambar (opsional)' : 'Upload Gambar' }}
                    </label>
                    <input type="file" name="gambar" id="gambar" accept="image/*" class="form-control"
                        onchange="previewImg(this)" />
                    @error('gambar')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                    <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                        Format: JPG, JPEG, PNG, WEBP. Maks 3 MB. Kosongkan jika tidak ingin mengganti.
                    </p>
                </div>
            </div>
        </div>

        {{-- Informasi Kontak --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Informasi Kontak</div>
            </div>
            <div class="card__body">
                <div class="form-group">
                    <label class="form-label" for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $peta->alamat) }}"
                        class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" />
                    @error('alamat')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="kota">Kota / Kode Pos</label>
                    <input type="text" name="kota" id="kota" value="{{ old('kota', $peta->kota) }}"
                        class="form-control" />
                </div>
                <div class="profile-grid">
                    <div class="form-group">
                        <label class="form-label" for="telepon">Telepon</label>
                        <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $peta->telepon) }}"
                            class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="faks">Faks</label>
                        <input type="text" name="faks" id="faks" value="{{ old('faks', $peta->faks) }}"
                            class="form-control" />
                    </div>
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $peta->email) }}"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" />
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Google Maps --}}
        <div class="card" style="margin-bottom:24px;">
            <div class="card__header">
                <div class="card__title">Google Maps Embed URL</div>
            </div>
            <div class="card__body">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="maps_embed_url">
                        URL embed (src dari iframe Google Maps — opsional)
                    </label>
                    <input type="text" name="maps_embed_url" id="maps_embed_url"
                        value="{{ old('maps_embed_url', $peta->maps_embed_url) }}" class="form-control" />
                    @error('maps_embed_url')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                    <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                        Salin nilai atribut <code>src</code> dari tag <code>&lt;iframe&gt;</code> embed Google Maps.
                    </p>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.peta-paroki.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        function toggleHapusHero(cb) {
            const heroPreview = document.getElementById('heroPreview');
            const heroInput = document.getElementById('hero_image');
            if (cb.checked) {
                if (heroPreview) { heroPreview.style.opacity = '0.3'; heroPreview.style.transition = 'opacity .2s'; }
                heroInput.disabled = true;
                heroInput.value = '';
            } else {
                if (heroPreview) heroPreview.style.opacity = '1';
                heroInput.disabled = false;
            }
        }

        document.getElementById('hero_image').addEventListener('change', function() {
            const hapusCheck = document.getElementById('hapusHeroCheck');
            if (hapusCheck && hapusCheck.checked) { hapusCheck.checked = false; toggleHapusHero(hapusCheck); }
        });

        function previewImg(input) {
            if (input.files && input.files[0]) {
                const img = document.getElementById('petaPreview');
                img.src = URL.createObjectURL(input.files[0]);
                img.style.display = 'block';
            }
        }
    </script>
@endsection
