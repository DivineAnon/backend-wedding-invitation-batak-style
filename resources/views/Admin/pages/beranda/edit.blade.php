@extends('Admin.Layouts.Admin')

@section('title', 'Edit Hero Beranda')
@section('page_title', 'Edit Hero Beranda')
@section('breadcrumb', 'Konten / Hero Beranda / Edit')

@section('content')
    <form action="{{ route('admin.beranda.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Hero Image --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Gambar Hero</div>
            </div>
            <div class="card__body">
                <img id="heroPreview" src="{{ media_url($hero->hero_image, 'assets/beranda') }}" alt="Hero Preview"
                    style="width:100%;max-width:600px;height:240px;object-fit:cover;border-radius:6px;border:1px solid var(--border);margin-bottom:12px;" />
                @if ($hero->hero_image)
                    <div style="margin-top:0;margin-bottom:12px">
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                            <input type="checkbox" name="hapus_hero" value="1" id="hapusHeroCheck" onchange="toggleHapusHero(this)">
                            <span style="font-size:13px;color:var(--danger)">Hapus hero image (kembali ke tampilan default)</span>
                        </label>
                    </div>
                @endif
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="hero_image">Ganti Gambar (opsional)</label>
                    <input type="file" name="hero_image" id="hero_image" accept="image/*" class="form-control" />
                    @error('hero_image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                    <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                        Format: JPG, JPEG, PNG, WEBP. Maks 5 MB. Kosongkan jika tidak ingin mengganti.
                    </p>
                </div>
            </div>
        </div>

        {{-- Konten Hero --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Konten Hero</div>
            </div>
            <div class="card__body">
                <div class="form-group">
                    <label class="form-label" for="tagline">Tagline <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="tagline" id="tagline"
                        value="{{ old('tagline', $hero->tagline) }}"
                        class="form-control {{ $errors->has('tagline') ? 'is-invalid' : '' }}" />
                    @error('tagline')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                    <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                        Teks besar di kiri bawah hero. Gunakan \n untuk baris baru (akan diproses otomatis).
                    </p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="card_title">Judul Card <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="card_title" id="card_title"
                        value="{{ old('card_title', $hero->card_title) }}"
                        class="form-control {{ $errors->has('card_title') ? 'is-invalid' : '' }}" />
                    @error('card_title')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="card_desc">Deskripsi Card <span style="color:var(--danger)">*</span></label>
                    <textarea name="card_desc" id="card_desc" rows="4"
                        class="form-control {{ $errors->has('card_desc') ? 'is-invalid' : '' }}">{{ old('card_desc', $hero->card_desc) }}</textarea>
                    @error('card_desc')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="profile-grid">
                    <div class="form-group">
                        <label class="form-label" for="button_text">Teks Tombol <span style="color:var(--danger)">*</span></label>
                        <input type="text" name="button_text" id="button_text"
                            value="{{ old('button_text', $hero->button_text) }}"
                            class="form-control {{ $errors->has('button_text') ? 'is-invalid' : '' }}" />
                        @error('button_text')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="button_link">Link Tombol <span style="color:var(--danger)">*</span></label>
                        <input type="text" name="button_link" id="button_link"
                            value="{{ old('button_link', $hero->button_link) }}"
                            class="form-control {{ $errors->has('button_link') ? 'is-invalid' : '' }}" />
                        @error('button_link')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                            Bisa anchor (#sejarah) atau URL lengkap.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.beranda.index') }}" class="btn btn-secondary">Batal</a>
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
        document.getElementById('hero_image').addEventListener('change', function () {
            const hapusCheck = document.getElementById('hapusHeroCheck');
            if (hapusCheck && hapusCheck.checked) { hapusCheck.checked = false; toggleHapusHero(hapusCheck); }
            const file = this.files[0];
            if (file) {
                document.getElementById('heroPreview').src = URL.createObjectURL(file);
            }
        });
    </script>
@endsection
