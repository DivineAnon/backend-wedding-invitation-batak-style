@extends('Admin.Layouts.Admin')

@section('title', 'Edit Sejarah')
@section('page_title', 'Edit Sejarah')
@section('breadcrumb', 'Konten / Sejarah / Edit')

@section('content')
    <form action="{{ route('admin.sejarah.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Hero Image --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Hero Image</div>
            </div>
            <div class="card__body">
                <img id="heroPreview" src="{{ media_url($sejarah->hero_image, 'assets/sejarah') }}" alt="Hero"
                    class="img-preview" />
                @if ($sejarah->hero_image)
                    <div style="margin-top:10px;margin-bottom:4px">
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                            <input type="checkbox" name="hapus_hero" value="1" id="hapusHeroCheck" onchange="toggleHapusHero(this)">
                            <span style="font-size:13px;color:var(--danger)">Hapus hero image (kembali ke tampilan default)</span>
                        </label>
                    </div>
                @endif
                <div class="form-group" style="margin-top:12px;margin-bottom:0;">
                    <label class="form-label" for="hero_image">Ganti Gambar (opsional)</label>
                    <input type="file" name="hero_image" id="hero_image" accept="image/*" class="form-control" />
                    @error('hero_image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                    <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                        Format: JPG, JPEG, PNG, WEBP. Maks 2 MB. Kosongkan jika tidak ingin mengganti.
                    </p>
                </div>
            </div>
        </div>

        {{-- Informasi Utama --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Informasi Utama</div>
            </div>
            <div class="card__body">
                <div class="profile-grid">
                    <div class="form-group">
                        <label class="form-label" for="accent_text">Accent Text (kiri atas hero)</label>
                        <input type="text" name="accent_text" id="accent_text"
                            value="{{ old('accent_text', $sejarah->accent_text) }}"
                            class="form-control {{ $errors->has('accent_text') ? 'is-invalid' : '' }}" />
                        @error('accent_text')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="year">Tahun (misal: 1906 &mdash; Kini)</label>
                        <input type="text" name="year" id="year" value="{{ old('year', $sejarah->year) }}"
                            class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" />
                        @error('year')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="label">Label Perjalanan</label>
                    <input type="text" name="label" id="label" value="{{ old('label', $sejarah->label) }}"
                        class="form-control {{ $errors->has('label') ? 'is-invalid' : '' }}" />
                    @error('label')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="source">Sumber (opsional)</label>
                    <input type="text" name="source" id="source" value="{{ old('source', $sejarah->source) }}"
                        class="form-control" />
                </div>
            </div>
        </div>

        {{-- Narasi --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Narasi / Isi</div>
                <button type="button" class="btn btn-secondary" id="addParagraph">+ Tambah Paragraf</button>
            </div>
            <div class="card__body" id="bodyContainer">
                @foreach (old('body', $sejarah->body) as $i => $para)
                    <div class="milestone-entry">
                        <label class="form-label">Paragraf {{ $i + 1 }}</label>
                        <textarea name="body[]" class="form-control" rows="4">{{ $para }}</textarea>
                        @if ($i > 0)
                            <button type="button" class="milestone-entry__remove"
                                onclick="this.closest('.milestone-entry').remove()">✕</button>
                        @endif
                    </div>
                @endforeach
            </div>
            @error('body')
                <p class="form-error" style="padding:0 24px 12px;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tonggak Sejarah --}}
        <div class="card" style="margin-bottom:24px;">
            <div class="card__header">
                <div class="card__title">Tonggak Sejarah</div>
                <button type="button" class="btn btn-secondary" id="addMilestone">+ Tambah</button>
            </div>
            <div class="card__body" id="milestoneContainer">
                @foreach (old('milestones', $sejarah->milestones->toArray()) as $i => $ms)
                    <div class="milestone-entry">
                        @if (!empty($ms['id']))
                            <input type="hidden" name="milestones[{{ $i }}][id]"
                                value="{{ $ms['id'] }}" />
                        @endif
                        <button type="button" class="milestone-entry__remove"
                            onclick="this.closest('.milestone-entry').remove()">✕</button>
                        <div class="milestone-entry .form-row"
                            style="display:grid;grid-template-columns:160px 1fr;gap:12px;margin-bottom:10px;">
                            <div class="form-group" style="margin:0;">
                                <label class="form-label">Tahun</label>
                                <input type="text" name="milestones[{{ $i }}][tahun]"
                                    value="{{ $ms['tahun'] }}" class="form-control" />
                            </div>
                            <div class="form-group" style="margin:0;">
                                <label class="form-label">Judul</label>
                                <input type="text" name="milestones[{{ $i }}][judul]"
                                    value="{{ $ms['judul'] }}" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="milestones[{{ $i }}][deskripsi]" class="form-control" rows="2">{{ $ms['deskripsi'] }}</textarea>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.sejarah.index') }}" class="btn btn-secondary">Batal</a>
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

        // Hero image preview
        document.getElementById('hero_image').addEventListener('change', function() {
            const hapusCheck = document.getElementById('hapusHeroCheck');
            if (hapusCheck && hapusCheck.checked) { hapusCheck.checked = false; toggleHapusHero(hapusCheck); }
            const file = this.files[0];
            if (file) {
                document.getElementById('heroPreview').src = URL.createObjectURL(file);
            }
        });

        // Add paragraph
        let paraCount = {{ count(old('body', $sejarah->body)) }};
        document.getElementById('addParagraph').addEventListener('click', function() {
            paraCount++;
            const wrap = document.createElement('div');
            wrap.className = 'milestone-entry';
            wrap.style.cssText = 'position:relative;padding-right:44px;';
            wrap.innerHTML = `
        <label class="form-label">Paragraf ${paraCount}</label>
        <textarea name="body[]" class="form-control" rows="4"></textarea>
        <button type="button" class="milestone-entry__remove" onclick="this.closest('.milestone-entry').remove()">✕</button>
    `;
            document.getElementById('bodyContainer').appendChild(wrap);
        });

        // Add milestone
        let msCount = {{ count(old('milestones', $sejarah->milestones->toArray())) }};
        document.getElementById('addMilestone').addEventListener('click', function() {
            const i = msCount++;
            const entry = document.createElement('div');
            entry.className = 'milestone-entry';
            entry.innerHTML = `
        <button type="button" class="milestone-entry__remove" onclick="this.closest('.milestone-entry').remove()">✕</button>
        <div style="display:grid;grid-template-columns:160px 1fr;gap:12px;margin-bottom:10px;">
            <div class="form-group" style="margin:0;">
                <label class="form-label">Tahun</label>
                <input type="text" name="milestones[${i}][tahun]" class="form-control" />
            </div>
            <div class="form-group" style="margin:0;">
                <label class="form-label">Judul</label>
                <input type="text" name="milestones[${i}][judul]" class="form-control" />
            </div>
        </div>
        <div class="form-group" style="margin:0;">
            <label class="form-label">Deskripsi</label>
            <textarea name="milestones[${i}][deskripsi]" class="form-control" rows="2"></textarea>
        </div>
    `;
            document.getElementById('milestoneContainer').appendChild(entry);
        });
    </script>
@endsection
