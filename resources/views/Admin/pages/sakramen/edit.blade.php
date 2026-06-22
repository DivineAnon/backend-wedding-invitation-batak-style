@extends('Admin.Layouts.Admin')

@section('title', 'Edit ' . $item->judul)
@section('page_title', 'Edit: ' . $item->judul)
@section('breadcrumb', 'Pelayanan / Sakramen / ' . $item->judul)

@section('topbar_actions')
    <a href="{{ route('admin.sakramen.index') }}" class="btn btn-secondary">← Kembali</a>
    <button type="submit" form="form-sakramen" class="btn btn-primary">Simpan Perubahan</button>
@endsection

@section('content')
    <form id="form-sakramen" action="{{ route('admin.sakramen.update', $item->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- URL Preview --}}
        <div class="sak-url-bar">
            <span class="sak-url-bar__label">URL Halaman</span>
            <code class="sak-url-bar__url">/pelayanan/sakramen/{{ $item->slug }}</code>
        </div>

        {{-- Informasi Utama --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Informasi Utama</div>
            </div>
            <div class="card__body">
                <div class="profile-grid">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" for="judul">Judul Halaman</label>
                        <input type="text" name="judul" id="judul"
                            value="{{ old('judul', $item->judul) }}"
                            class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}" required />
                        @error('judul')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" for="deskripsi">Deskripsi Singkat</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"
                            placeholder="Deskripsi yang tampil di bagian intro halaman...">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                    </div>
                </div>

                {{-- Accent Text --}}
                <div class="form-group" style="margin-top:20px;">
                    <label class="form-label" for="accent_text">Subtitle Hero (Accent Text)</label>
                    <input type="text" name="accent_text" id="accent_text"
                        value="{{ old('accent_text', $item->accent_text) }}"
                        class="form-control {{ $errors->has('accent_text') ? 'is-invalid' : '' }}"
                        placeholder="Pelayanan Sakramen · Paroki Santo Yoseph Matraman">
                    @error('accent_text')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                    <p style="font-size:11px;color:var(--muted);margin-top:4px;">Teks subtitle yang ditampilkan di bawah judul pada bagian hero. Kosongkan untuk teks default.</p>
                </div>

                {{-- Hero Image Section --}}
                <div style="margin-top:24px;padding-top:24px;border-top:1px solid var(--border);;">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;align-items:start;">
                        {{-- Upload Form --}}
                        <div>
                            <label class="form-label" for="hero_image">Gambar Hero (Banner)</label>
                            <div style="margin-top:8px;">
                                <label style="display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:120px;border:2px dashed var(--border);border-radius:8px;cursor:pointer;transition:all 200ms;background:rgba(var(--primary-rgb), 0.02);"
                                    onmouseover="this.style.borderColor='var(--primary)';this.style.background='rgba(var(--primary-rgb), 0.05)'" 
                                    onmouseout="this.style.borderColor='var(--border)';this.style.background='rgba(var(--primary-rgb), 0.02)'">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color:var(--muted);margin-bottom:8px;">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                    <span style="font-size:13px;color:var(--muted);text-align:center;">
                                        <strong style="color:var(--text);">Klik untuk upload</strong><br/>atau drag & drop
                                    </span>
                                    <input type="file" id="hero_image" name="hero_image" accept="image/jpeg,image/png,image/gif,image/webp" 
                                        style="display:none;" onchange="previewHero(this)" />
                                </label>
                                <p style="font-size:12px;color:var(--muted);margin-top:8px;text-align:center;">
                                    JPG, PNG, GIF, atau WebP • Max 5 MB
                                </p>
                                @error('hero_image')
                                    <p class="form-error" style="margin-top:8px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Preview & Current Image --}}
                        <div>
                            <label class="form-label">Pratinjau</label>
                            <div id="hero-preview-wrap" style="border:1px solid var(--border);border-radius:8px;overflow:hidden;background:var(--bg-secondary);">
                                @if ($item->hero_image)
                                    <img id="preview-hero" src="{{ media_url($item->hero_image, 'assets/sakramen') }}"
                                        alt="Preview" style="width:100%;height:200px;object-fit:cover;display:block;" />
                                @else
                                    <div id="preview-hero" style="width:100%;height:200px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#1c0a02 0%,#0a0a0a 65%);">
                                        <span style="font-size:12px;color:rgba(255,255,255,.35)">Belum ada gambar hero</span>
                                    </div>
                                @endif
                            </div>
                            @if ($item->hero_image)
                                <p style="font-size:12px;color:var(--muted);margin-top:8px;text-align:center;">
                                    File saat ini: <strong>{{ basename($item->hero_image) }}</strong>
                                </p>
                                <div style="margin-top:8px">
                                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                                        <input type="checkbox" name="hapus_hero" value="1" id="hapusHeroCheck" onchange="toggleHapusHero(this)">
                                        <span style="font-size:13px;color:var(--danger)">Hapus hero image (kembali ke tampilan default)</span>
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-form-grid">

            {{-- Kiri: Seksi Konten --}}
            <div>
                <div class="card">
                    <div class="card__header">
                        <div>
                            <div class="card__title">Seksi Konten</div>
                            <div style="font-size:12px;color:var(--muted);margin-top:2px;">
                                Tiap seksi terdiri dari judul, paragraf, dan/atau poin daftar.
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" style="font-size:12px;padding:5px 14px;flex-shrink:0;"
                            onclick="addSection()">+ Tambah Seksi</button>
                    </div>
                    <div class="card__body" id="sections-container" style="padding-bottom:8px;">
                        @php $sections = old('sections', $item->sections ?? []); @endphp

                        @if (empty($sections))
                            <div class="sak-empty" id="sections-empty">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                </svg>
                                <p>Belum ada seksi. Klik <strong>+ Tambah Seksi</strong> untuk memulai.</p>
                            </div>
                        @endif

                        @foreach ($sections as $si => $sec)
                            <div class="sak-section milestone-entry" data-sec="{{ $si }}">
                                <button type="button" class="milestone-entry__remove"
                                    onclick="removeSection(this)" title="Hapus seksi">✕</button>

                                {{-- Section header --}}
                                <div class="sak-section__hd">
                                    <span class="sak-section__num">{{ str_pad($si + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div style="flex:1;">
                                        <label class="form-label" style="margin-bottom:4px;">Judul Seksi</label>
                                        <input type="text" name="sections[{{ $si }}][judul]"
                                            value="{{ $sec['judul'] ?? '' }}"
                                            class="form-control" placeholder="cth. Persyaratan, Prosedur, Jadwal…" />
                                    </div>
                                </div>

                                {{-- Paragraf sub-group --}}
                                <div class="sak-subgroup">
                                    <div class="sak-subgroup__hd">
                                        <span class="sak-subgroup__label">Paragraf</span>
                                        <button type="button" class="btn btn-secondary"
                                            style="font-size:11px;padding:3px 10px;"
                                            onclick="addParagraf({{ $si }})">+ Tambah</button>
                                    </div>
                                    <div id="par-{{ $si }}" class="sak-subgroup__body">
                                        @forelse ($sec['paragraf'] ?? [] as $pi => $par)
                                            <div class="sak-row">
                                                <textarea name="sections[{{ $si }}][paragraf][{{ $pi }}]"
                                                    class="form-control" rows="2"
                                                    placeholder="Isi paragraf…">{{ $par }}</textarea>
                                                <button type="button" class="sak-row__del"
                                                    onclick="this.closest('.sak-row').remove()" title="Hapus">✕</button>
                                            </div>
                                        @empty
                                            <p class="sak-subgroup__hint">Belum ada paragraf.</p>
                                        @endforelse
                                    </div>
                                </div>

                                {{-- List sub-group --}}
                                <div class="sak-subgroup" style="margin-bottom:0;">
                                    <div class="sak-subgroup__hd">
                                        <span class="sak-subgroup__label">Poin Daftar</span>
                                        <button type="button" class="btn btn-secondary"
                                            style="font-size:11px;padding:3px 10px;"
                                            onclick="addListItem({{ $si }})">+ Tambah</button>
                                    </div>
                                    <div id="list-{{ $si }}" class="sak-subgroup__body">
                                        @forelse ($sec['list'] ?? [] as $li => $listItem)
                                            <div class="sak-row">
                                                <input type="text"
                                                    name="sections[{{ $si }}][list][{{ $li }}]"
                                                    value="{{ $listItem }}"
                                                    class="form-control"
                                                    placeholder="cth. Mengisi formulir pendaftaran" />
                                                <button type="button" class="sak-row__del"
                                                    onclick="this.closest('.sak-row').remove()" title="Hapus">✕</button>
                                            </div>
                                        @empty
                                            <p class="sak-subgroup__hint">Belum ada poin.</p>
                                        @endforelse
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Kanan: Kontak + Unduhan + Save --}}
            <div>

                {{-- Kontak --}}
                <div class="card" style="margin-bottom:16px;">
                    <div class="card__header">
                        <div>
                            <div class="card__title">Informasi Kontak</div>
                            <div style="font-size:12px;color:var(--muted);margin-top:2px;">Opsional — kosongkan jika tidak ada.</div>
                        </div>
                    </div>
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="kontak_nama">Nama / Bagian</label>
                            <input type="text" name="kontak_nama" id="kontak_nama"
                                value="{{ old('kontak_nama', $item->kontak_nama) }}"
                                class="form-control" placeholder="cth. Sekretariat Paroki" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="kontak_telepon">Nomor Telepon</label>
                            <input type="text" name="kontak_telepon" id="kontak_telepon"
                                value="{{ old('kontak_telepon', $item->kontak_telepon) }}"
                                class="form-control" placeholder="cth. (021) 858-3782" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="kontak_email">Email</label>
                            <input type="email" name="kontak_email" id="kontak_email"
                                value="{{ old('kontak_email', $item->kontak_email) }}"
                                class="form-control" placeholder="cth. info@parokimatraman.id" />
                            @error('kontak_email')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" for="kontak_catatan">Catatan</label>
                            <textarea name="kontak_catatan" id="kontak_catatan"
                                class="form-control" rows="2"
                                placeholder="cth. Hubungi sekretariat saat jam kantor.">{{ old('kontak_catatan', $item->kontak_catatan) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Unduhan --}}
                <div class="card" style="margin-bottom:16px;">
                    <div class="card__header">
                        <div>
                            <div class="card__title">File Unduhan</div>
                            <div style="font-size:12px;color:var(--muted);margin-top:2px;">Opsional — kosongkan jika tidak ada.</div>
                        </div>
                        <button type="button" class="btn btn-secondary"
                            style="font-size:12px;padding:5px 14px;flex-shrink:0;"
                            onclick="addUnduhan()">+ Tambah</button>
                    </div>
                    <div class="card__body" style="padding-top:12px;" id="unduhan-card-body">
                        <div id="unduhan-container">
                            @php $unduhan = old('unduhan', $item->unduhan ?? []); @endphp
                            @forelse ($unduhan as $ui => $ud)
                                <div class="milestone-entry sak-unduhan-entry">
                                    <button type="button" class="milestone-entry__remove"
                                        onclick="this.closest('.sak-unduhan-entry').remove()" title="Hapus">✕</button>
                                    <div class="form-group">
                                        <label class="form-label">Nama File</label>
                                        <input type="text" name="unduhan[{{ $ui }}][nama]"
                                            value="{{ $ud['nama'] ?? '' }}"
                                            class="form-control" placeholder="cth. Formulir Baptis Bayi" />
                                    </div>
                                    <div class="form-group" style="margin-bottom:0;">
                                        <label class="form-label">URL / Link</label>
                                        <input type="text" name="unduhan[{{ $ui }}][url]"
                                            value="{{ $ud['url'] ?? '' }}"
                                            class="form-control" placeholder="https://…" />
                                    </div>
                                </div>
                            @empty
                                <p class="sak-subgroup__hint" id="unduhan-empty">Belum ada file unduhan.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Save sticky --}}
                <div class="sak-save-box">
                    <button type="submit" form="form-sakramen" class="btn btn-primary" style="flex:1;justify-content:center;">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.sakramen.index') }}" class="btn btn-secondary">Batal</a>
                </div>

            </div>
        </div>

    </form>
@endsection

@section('styles')
<style>
    /* ── URL bar ──────────────────────────────────── */
    .sak-url-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 10px 16px;
        margin-bottom: 20px;
    }

    .sak-url-bar__label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .05em;
        text-transform: uppercase;
        color: var(--muted);
        white-space: nowrap;
    }

    .sak-url-bar__url {
        font-size: 12px;
        color: var(--accent);
        background: var(--bg);
        padding: 3px 10px;
        border-radius: 5px;
        border: 1px solid var(--border);
    }

    /* ── Section block ────────────────────────────── */
    .sak-section {
        padding-top: 12px;
    }

    .sak-section__hd {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 16px;
    }

    .sak-section__num {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        background: var(--accent);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        flex-shrink: 0;
        margin-top: 22px;
        letter-spacing: .04em;
    }

    /* ── Sub-groups (Paragraf / List inside a section) ── */
    .sak-subgroup {
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px solid var(--border);
    }

    .sak-subgroup__hd {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .sak-subgroup__label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--muted);
    }

    .sak-subgroup__body {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .sak-subgroup__hint {
        font-size: 12px;
        color: var(--muted);
        font-style: italic;
        padding: 4px 0;
    }

    /* ── Dynamic rows (textarea/input + remove) ────── */
    .sak-row {
        display: flex;
        gap: 6px;
        align-items: flex-start;
    }

    .sak-row .form-control {
        flex: 1;
    }

    .sak-row__del {
        flex-shrink: 0;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: none;
        border: 1px solid var(--border);
        border-radius: 6px;
        cursor: pointer;
        color: var(--muted);
        font-size: 12px;
        margin-top: 10px;
        transition: color .12s, background .12s, border-color .12s;
    }

    .sak-row__del:hover {
        color: var(--danger);
        border-color: var(--danger);
        background: #fdf2f2;
    }

    /* ── Empty state ──────────────────────────────── */
    .sak-empty {
        text-align: center;
        padding: 32px 24px;
        color: var(--muted);
    }

    .sak-empty svg {
        display: block;
        margin: 0 auto 12px;
        opacity: .4;
    }

    .sak-empty p {
        font-size: 13px;
        line-height: 1.6;
    }

    /* ── Unduhan entry (reuses milestone-entry) ─────── */
    .sak-unduhan-entry {
        padding-top: 20px;
        margin-bottom: 12px;
    }

    /* ── Save sticky box ──────────────────────────── */
    .sak-save-box {
        display: flex;
        gap: 8px;
        align-items: center;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 14px 16px;
        position: sticky;
        bottom: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    /* ── Override admin-form-grid right col width ──── */
    .admin-form-grid {
        grid-template-columns: 1fr 320px;
    }

    @media (max-width: 900px) {
        .admin-form-grid {
            grid-template-columns: 1fr;
        }
        .sak-save-box {
            position: static;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    var secCount   = {{ count(old('sections', $item->sections ?? [])) }};
    var parCounts  = {};
    var listCounts = {};
    var unduhanCount = {{ count(old('unduhan', $item->unduhan ?? [])) }};

    @foreach (old('sections', $item->sections ?? []) as $si => $sec)
        parCounts[{{ $si }}]  = {{ count($sec['paragraf'] ?? []) }};
        listCounts[{{ $si }}] = {{ count($sec['list'] ?? []) }};
    @endforeach

    function hideEmpty(id) {
        var el = document.getElementById(id);
        if (el) el.remove();
    }

    function removeSection(btn) {
        btn.closest('.sak-section').remove();
        // Re-show empty if no sections left
        if (!document.querySelector('.sak-section')) {
            var c = document.getElementById('sections-container');
            if (!document.getElementById('sections-empty')) {
                var p = document.createElement('div');
                p.id = 'sections-empty';
                p.className = 'sak-empty';
                p.innerHTML = '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg><p>Belum ada seksi. Klik <strong>+ Tambah Seksi</strong> untuk memulai.</p>';
                c.appendChild(p);
            }
        }
    }

    function addSection() {
        hideEmpty('sections-empty');
        var idx = secCount++;
        parCounts[idx]  = 0;
        listCounts[idx] = 0;
        var numLabel = String(idx + 1).padStart(2, '0');
        var div = document.createElement('div');
        div.className = 'sak-section milestone-entry';
        div.dataset.sec = idx;
        div.innerHTML = `
            <button type="button" class="milestone-entry__remove" onclick="removeSection(this)" title="Hapus seksi">✕</button>
            <div class="sak-section__hd">
                <span class="sak-section__num">${numLabel}</span>
                <div style="flex:1;">
                    <label class="form-label" style="margin-bottom:4px;">Judul Seksi</label>
                    <input type="text" name="sections[${idx}][judul]" class="form-control"
                        placeholder="cth. Persyaratan, Prosedur, Jadwal…" />
                </div>
            </div>
            <div class="sak-subgroup">
                <div class="sak-subgroup__hd">
                    <span class="sak-subgroup__label">Paragraf</span>
                    <button type="button" class="btn btn-secondary" style="font-size:11px;padding:3px 10px;"
                        onclick="addParagraf(${idx})">+ Tambah</button>
                </div>
                <div id="par-${idx}" class="sak-subgroup__body">
                    <p class="sak-subgroup__hint">Belum ada paragraf.</p>
                </div>
            </div>
            <div class="sak-subgroup" style="margin-bottom:0;">
                <div class="sak-subgroup__hd">
                    <span class="sak-subgroup__label">Poin Daftar</span>
                    <button type="button" class="btn btn-secondary" style="font-size:11px;padding:3px 10px;"
                        onclick="addListItem(${idx})">+ Tambah</button>
                </div>
                <div id="list-${idx}" class="sak-subgroup__body">
                    <p class="sak-subgroup__hint">Belum ada poin.</p>
                </div>
            </div>
        `;
        document.getElementById('sections-container').appendChild(div);
    }

    function addParagraf(secIdx) {
        if (!parCounts[secIdx]) parCounts[secIdx] = 0;
        var pi = parCounts[secIdx]++;
        var container = document.getElementById('par-' + secIdx);
        // Remove hint if present
        var hint = container.querySelector('.sak-subgroup__hint');
        if (hint) hint.remove();
        var div = document.createElement('div');
        div.className = 'sak-row';
        div.innerHTML = `
            <textarea name="sections[${secIdx}][paragraf][${pi}]" class="form-control" rows="2"
                placeholder="Isi paragraf…"></textarea>
            <button type="button" class="sak-row__del" onclick="this.closest('.sak-row').remove()" title="Hapus">✕</button>
        `;
        container.appendChild(div);
    }

    function addListItem(secIdx) {
        if (!listCounts[secIdx]) listCounts[secIdx] = 0;
        var li = listCounts[secIdx]++;
        var container = document.getElementById('list-' + secIdx);
        var hint = container.querySelector('.sak-subgroup__hint');
        if (hint) hint.remove();
        var div = document.createElement('div');
        div.className = 'sak-row';
        div.innerHTML = `
            <input type="text" name="sections[${secIdx}][list][${li}]" class="form-control"
                placeholder="cth. Mengisi formulir pendaftaran" />
            <button type="button" class="sak-row__del" onclick="this.closest('.sak-row').remove()" title="Hapus">✕</button>
        `;
        container.appendChild(div);
    }

    function addUnduhan() {
        var ui = unduhanCount++;
        var container = document.getElementById('unduhan-container');
        var hint = document.getElementById('unduhan-empty');
        if (hint) hint.remove();
        var div = document.createElement('div');
        div.className = 'milestone-entry sak-unduhan-entry';
        div.innerHTML = `
            <button type="button" class="milestone-entry__remove"
                onclick="this.closest('.sak-unduhan-entry').remove()" title="Hapus">✕</button>
            <div class="form-group">
                <label class="form-label">Nama File</label>
                <input type="text" name="unduhan[${ui}][nama]" class="form-control"
                    placeholder="cth. Formulir Baptis Bayi" />
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">URL / Link</label>
                <input type="text" name="unduhan[${ui}][url]" class="form-control"
                    placeholder="https://…" />
            </div>
        `;
        container.appendChild(div);
    }

    function toggleHapusHero(cb) {
        const wrap = document.getElementById('hero-preview-wrap');
        const heroInput = document.getElementById('hero_image');
        if (cb.checked) {
            if (wrap) wrap.style.opacity = '0.3';
            heroInput.disabled = true;
            heroInput.value = '';
        } else {
            if (wrap) wrap.style.opacity = '1';
            heroInput.disabled = false;
        }
    }

    function previewHero(input) {
        const hapusCheck = document.getElementById('hapusHeroCheck');
        if (hapusCheck && hapusCheck.checked) { hapusCheck.checked = false; toggleHapusHero(hapusCheck); }
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                const wrap = document.getElementById('hero-preview-wrap');
                wrap.innerHTML = '<img id="preview-hero" src="' + e.target.result + '" alt="Preview" style="width:100%;height:200px;object-fit:cover;display:block;" />';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
