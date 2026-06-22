@extends('Admin.Layouts.Admin')

@section('title', 'Edit Visi & Misi')
@section('page_title', 'Edit Visi & Misi')
@section('breadcrumb', 'Konten / Visi & Misi / Edit')

@section('content')
    <form action="{{ route('admin.visi-misi.update') }}" method="POST" enctype="multipart/form-data">
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
                @if ($visiMisi->hero_image)
                    <div style="margin-top:16px;">
                        <p style="font-size:12px;color:var(--muted);margin-bottom:8px;">Preview Gambar:</p>
                        <img id="heroPreview" src="{{ media_url($visiMisi->hero_image, 'assets/visi-misi') }}" alt="Hero"
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
                        value="{{ old('accent_text', $visiMisi->accent_text) }}"
                        class="form-control {{ $errors->has('accent_text') ? 'is-invalid' : '' }}"
                        placeholder="Landasan dan arah pelayanan paroki">
                    @error('accent_text')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                    <p style="font-size:11px;color:var(--muted);margin-top:4px;">Teks yang ditampilkan di sisi kanan hero. Kosongkan untuk menggunakan teks default.</p>
                </div>
            </div>
        </div>

        {{-- Visi --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Visi</div>
            </div>
            <div class="card__body">
                <div class="form-group" style="margin:0;">
                    <textarea name="visi" id="visi" class="form-control {{ $errors->has('visi') ? 'is-invalid' : '' }}"
                        rows="5">{{ old('visi', $visiMisi->visi) }}</textarea>
                    @error('visi')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Misi Intro --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Misi — Intro</div>
            </div>
            <div class="card__body">
                <div class="form-group" style="margin:0;">
                    <textarea name="misi_intro" id="misi_intro" class="form-control {{ $errors->has('misi_intro') ? 'is-invalid' : '' }}"
                        rows="5">{{ old('misi_intro', $visiMisi->misi_intro) }}</textarea>
                    @error('misi_intro')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Pilar Misi --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Pilar Misi</div>
                <button type="button" class="btn btn-secondary" id="addPillar">+ Tambah Pilar</button>
            </div>
            <div class="card__body" id="pillarContainer">
                @foreach (old('misi_pillars', $visiMisi->misi_pillars ?? []) as $i => $pillar)
                    <div class="milestone-entry">
                        <button type="button" class="milestone-entry__remove"
                            onclick="this.closest('.milestone-entry').remove()">✕</button>
                        <div style="display:grid;grid-template-columns:200px 1fr;gap:12px;margin-bottom:10px;">
                            <div class="form-group" style="margin:0;">
                                <label class="form-label">Nama Pilar</label>
                                <input type="text" name="misi_pillars[{{ $i }}][nama]"
                                    value="{{ $pillar['nama'] }}" class="form-control" />
                            </div>
                            <div class="form-group" style="margin:0;">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="misi_pillars[{{ $i }}][deskripsi]" class="form-control" rows="3">{{ $pillar['deskripsi'] }}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Spiritualitas --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Spiritualitas</div>
            </div>
            <div class="card__body">
                <div class="form-group" style="margin:0;">
                    <textarea name="spiritualitas" id="spiritualitas" class="form-control" rows="5">{{ old('spiritualitas', $visiMisi->spiritualitas) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Nilai-Nilai --}}
        <div class="card" style="margin-bottom:24px;">
            <div class="card__header">
                <div class="card__title">Nilai-Nilai</div>
                <button type="button" class="btn btn-secondary" id="addNilai">+ Tambah Nilai</button>
            </div>
            <div class="card__body" id="nilaiContainer">
                @foreach (old('nilai_nilai', $visiMisi->nilai_nilai ?? []) as $nilai)
                    <div class="milestone-entry" style="position:relative;padding-right:44px;">
                        <input type="text" name="nilai_nilai[]" value="{{ $nilai }}" class="form-control" />
                        <button type="button" class="milestone-entry__remove"
                            onclick="this.closest('.milestone-entry').remove()">✕</button>
                    </div>
                @endforeach
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.visi-misi.index') }}" class="btn btn-secondary">Batal</a>
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

        let pillarCount = {{ count(old('misi_pillars', $visiMisi->misi_pillars ?? [])) }};
        document.getElementById('addPillar').addEventListener('click', function() {
            const i = pillarCount++;
            const entry = document.createElement('div');
            entry.className = 'milestone-entry';
            entry.innerHTML = `
                <button type="button" class="milestone-entry__remove" onclick="this.closest('.milestone-entry').remove()">✕</button>
                <div style="display:grid;grid-template-columns:200px 1fr;gap:12px;margin-bottom:10px;">
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">Nama Pilar</label>
                        <input type="text" name="misi_pillars[${i}][nama]" class="form-control" />
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="misi_pillars[${i}][deskripsi]" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            `;
            document.getElementById('pillarContainer').appendChild(entry);
        });

        document.getElementById('addNilai').addEventListener('click', function() {
            const entry = document.createElement('div');
            entry.className = 'milestone-entry';
            entry.style.cssText = 'position:relative;padding-right:44px;';
            entry.innerHTML = `
                <input type="text" name="nilai_nilai[]" class="form-control" />
                <button type="button" class="milestone-entry__remove" onclick="this.closest('.milestone-entry').remove()">✕</button>
            `;
            document.getElementById('nilaiContainer').appendChild(entry);
        });
    </script>
@endsection
