@extends('Admin.Layouts.Admin')

@section('title', 'Edit Jam Pelayanan')
@section('page_title', 'Edit Jam Pelayanan')
@section('breadcrumb', 'Konten / Jam Pelayanan / Edit')

@section('topbar_actions')
    <a href="{{ route('admin.jam-pelayanan.index') }}" class="btn btn-secondary">← Kembali</a>
    <button type="submit" form="form-jam" class="btn btn-primary">Simpan Perubahan</button>
@endsection

@section('content')
    <form id="form-jam" action="{{ route('admin.jam-pelayanan.update') }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        {{-- Hidden real fields that get combined by JS --}}
        <input type="hidden" name="jam_senin_jumat" id="jam_senin_jumat" value="{{ old('jam_senin_jumat', $peta->jam_senin_jumat) }}" />
        <input type="hidden" name="jam_sabtu"       id="jam_sabtu"       value="{{ old('jam_sabtu',       $peta->jam_sabtu) }}" />
        <input type="hidden" name="jam_minggu"      id="jam_minggu"      value="{{ old('jam_minggu',      $peta->jam_minggu) }}" />

        {{-- Header card --}}
        <div class="jp-page-header">
            <div class="jp-page-header__icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <div>
                <div class="jp-page-header__title">Jam Operasional Sekretariat</div>
                <div class="jp-page-header__sub">Tentukan jam buka sekretariat per hari. Data ini tampil di Peta Paroki, Kontak, dan Footer.</div>
            </div>
        </div>

        {{-- Day slots --}}
        <div class="jp-edit-grid">

            {{-- Senin – Jumat --}}
            <div class="jp-edit-slot jp-edit-slot--primary">
                <div class="jp-edit-slot__head">
                    <span class="jp-edit-slot__day">Senin — Jumat</span>
                    <span class="jp-edit-slot__badge">Hari Kerja</span>
                </div>
                <div class="jp-time-range" data-target="jam_senin_jumat">
                    <div class="jp-time-range__field">
                        <label class="jp-time-range__label">Buka</label>
                        <input type="time" class="jp-time-input jp-time-start" data-target="jam_senin_jumat" />
                        @error('jam_senin_jumat')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="jp-time-range__sep">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </div>
                    <div class="jp-time-range__field">
                        <label class="jp-time-range__label">Tutup</label>
                        <input type="time" class="jp-time-input jp-time-end" data-target="jam_senin_jumat" />
                    </div>
                </div>
                <div class="jp-time-preview" id="preview_jam_senin_jumat"></div>
            </div>

            {{-- Sabtu --}}
            <div class="jp-edit-slot">
                <div class="jp-edit-slot__head">
                    <span class="jp-edit-slot__day">Sabtu</span>
                    <span class="jp-edit-slot__badge jp-edit-slot__badge--alt">Sabtu</span>
                </div>
                <div class="jp-time-range" data-target="jam_sabtu">
                    <div class="jp-time-range__field">
                        <label class="jp-time-range__label">Buka</label>
                        <input type="time" class="jp-time-input jp-time-start" data-target="jam_sabtu" />
                        @error('jam_sabtu')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="jp-time-range__sep">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </div>
                    <div class="jp-time-range__field">
                        <label class="jp-time-range__label">Tutup</label>
                        <input type="time" class="jp-time-input jp-time-end" data-target="jam_sabtu" />
                    </div>
                </div>
                <div class="jp-time-preview" id="preview_jam_sabtu"></div>
            </div>

            {{-- Minggu --}}
            <div class="jp-edit-slot">
                <div class="jp-edit-slot__head">
                    <span class="jp-edit-slot__day">Minggu</span>
                    <span class="jp-edit-slot__badge jp-edit-slot__badge--sun">Minggu</span>
                </div>
                <div class="jp-time-range" data-target="jam_minggu">
                    <div class="jp-time-range__field">
                        <label class="jp-time-range__label">Buka</label>
                        <input type="time" class="jp-time-input jp-time-start" data-target="jam_minggu" />
                        @error('jam_minggu')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="jp-time-range__sep">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </div>
                    <div class="jp-time-range__field">
                        <label class="jp-time-range__label">Tutup</label>
                        <input type="time" class="jp-time-input jp-time-end" data-target="jam_minggu" />
                    </div>
                </div>
                <div class="jp-time-preview" id="preview_jam_minggu"></div>
            </div>

        </div>

        {{-- Catatan --}}
        <div class="card" style="margin-bottom:28px;">
            <div class="card__header">
                <div class="card__title">Catatan Pelayanan</div>
                <span style="font-size:11px;color:var(--muted);">Opsional</span>
            </div>
            <div class="card__body">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label" for="catatan_pelayanan">Informasi tambahan</label>
                    <textarea name="catatan_pelayanan" id="catatan_pelayanan" class="form-control" rows="3"
                        placeholder="cth. Sekretariat melayani keperluan administrasi selama jam kerja. Hubungi terlebih dahulu untuk keperluan di luar jam tersebut.">{{ old('catatan_pelayanan', $peta->catatan_pelayanan) }}</textarea>
                    <p style="font-size:11px;color:var(--muted);margin-top:4px;">Akan tampil di bawah jam pelayanan di semua halaman.</p>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <button type="submit" form="form-jam" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.jam-pelayanan.index') }}" class="btn btn-secondary">Batal</a>
        </div>

    </form>
@endsection

@section('styles')
<style>
    /* ── Page header ────────────────────────────────── */
    .jp-page-header {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 28px;
    }
    .jp-page-header__icon {
        width: 44px;
        height: 44px;
        background: color-mix(in srgb, var(--accent) 10%, transparent);
        border: 1px solid color-mix(in srgb, var(--accent) 25%, transparent);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        flex-shrink: 0;
    }
    .jp-page-header__title {
        font-size: 15px;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 4px;
    }
    .jp-page-header__sub {
        font-size: 12px;
        color: var(--muted);
        line-height: 1.5;
    }

    /* ── Edit grid ──────────────────────────────────── */
    .jp-edit-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .jp-edit-slot {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 22px 20px;
    }

    .jp-edit-slot--primary {
        border-color: color-mix(in srgb, var(--accent) 30%, transparent);
        box-shadow: 0 0 0 1px color-mix(in srgb, var(--accent) 10%, transparent);
    }

    .jp-edit-slot__head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .jp-edit-slot__day {
        font-size: 13px;
        font-weight: 600;
        color: var(--text);
    }

    .jp-edit-slot__badge {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--muted);
        background: var(--bg);
        border: 1px solid var(--border);
        padding: 2px 9px;
        border-radius: 20px;
    }

    .jp-edit-slot__badge--alt {
        color: #7c6bff;
        background: rgba(124, 107, 255, .08);
        border-color: rgba(124, 107, 255, .18);
    }

    .jp-edit-slot__badge--sun {
        color: #e9a84c;
        background: rgba(233, 168, 76, .1);
        border-color: rgba(233, 168, 76, .22);
    }

    /* ── Time range picker ──────────────────────────── */
    .jp-time-range {
        display: flex;
        align-items: flex-end;
        gap: 10px;
    }

    .jp-time-range__field {
        flex: 1;
        min-width: 0;
    }

    .jp-time-range__label {
        display: block;
        font-size: 10px;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 6px;
    }

    .jp-time-input {
        width: 100%;
        padding: 9px 10px;
        border: 1px solid var(--border);
        border-radius: var(--radius, 6px);
        background: var(--bg);
        color: var(--text);
        font-size: 13px;
        font-family: inherit;
        outline: none;
        transition: border-color 0.15s;
        box-sizing: border-box;
    }

    .jp-time-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 2px color-mix(in srgb, var(--accent) 15%, transparent);
    }

    .jp-time-input.is-invalid {
        border-color: #ef4444;
    }

    .jp-time-range__sep {
        color: var(--muted);
        flex-shrink: 0;
        padding-bottom: 10px;
        display: flex;
        align-items: center;
    }

    /* ── Preview ────────────────────────────────────── */
    .jp-time-preview {
        margin-top: 12px;
        padding: 8px 12px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        color: var(--accent);
        min-height: 34px;
        display: flex;
        align-items: center;
    }

    .jp-time-preview:empty::before {
        content: 'Pilih jam buka & tutup';
        color: var(--muted);
        font-weight: 400;
        font-style: italic;
    }

    /* ── Responsive ─────────────────────────────────── */
    @media (max-width: 960px) {
        .jp-edit-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
        .jp-edit-grid { grid-template-columns: 1fr; }
        .jp-page-header { flex-direction: column; }
    }
</style>
@endsection

@section('scripts')
<script>
(function () {
    // Convert "HH.MM" (or "HH:MM") → "HH:MM" for input[type=time]
    function toTimeInput(str) {
        if (!str) return '';
        return str.replace('.', ':').substring(0, 5);
    }

    // Convert "HH:MM" → "HH.MM" (Indonesian dot format)
    function toDisplayTime(str) {
        if (!str) return '';
        return str.replace(':', '.');
    }

    // Parse "HH.MM – HH.MM" → {start, end}
    function parseRange(val) {
        if (!val) return { start: '', end: '' };
        const parts = val.split(/\s*[–\-]\s*/);
        return {
            start: parts[0] ? toTimeInput(parts[0].trim()) : '',
            end:   parts[1] ? toTimeInput(parts[1].trim()) : '',
        };
    }

    // Combine two "HH:MM" → "HH.MM – HH.MM"
    function buildRange(start, end) {
        const s = toDisplayTime(start);
        const e = toDisplayTime(end);
        if (!s && !e) return '';
        if (!e) return s;
        return s + ' \u2013 ' + e;
    }

    // Update preview element
    function updatePreview(targetId, start, end) {
        var el = document.getElementById('preview_' + targetId);
        if (!el) return;
        var val = buildRange(start, end);
        el.textContent = val || '';
    }

    // Fields to manage
    var fields = ['jam_senin_jumat', 'jam_sabtu', 'jam_minggu'];

    fields.forEach(function (id) {
        var hiddenInput = document.getElementById(id);
        var currentVal  = hiddenInput ? hiddenInput.value : '';
        var parsed      = parseRange(currentVal);

        // Find the start and end inputs for this slot
        var startInput = document.querySelector('.jp-time-start[data-target="' + id + '"]');
        var endInput   = document.querySelector('.jp-time-end[data-target="' + id + '"]');

        if (!startInput || !endInput || !hiddenInput) return;

        // Populate from current value
        startInput.value = parsed.start;
        endInput.value   = parsed.end;
        updatePreview(id, parsed.start, parsed.end);

        function onChange() {
            var s = startInput.value;
            var e = endInput.value;

            // Validate: end must be after start (if both filled)
            if (s && e && s >= e) {
                endInput.setCustomValidity('Jam tutup harus setelah jam buka.');
                endInput.classList.add('is-invalid');
            } else {
                endInput.setCustomValidity('');
                endInput.classList.remove('is-invalid');
            }

            hiddenInput.value = buildRange(s, e);
            updatePreview(id, s, e);
        }

        startInput.addEventListener('change', onChange);
        endInput.addEventListener('change', onChange);
    });

    // Final check + double-submit protection
    var _submitBusy = false;
    document.getElementById('form-jam').addEventListener('submit', function (e) {
        // Time validation
        var hasError = false;
        fields.forEach(function (id) {
            var startInput = document.querySelector('.jp-time-start[data-target="' + id + '"]');
            var endInput   = document.querySelector('.jp-time-end[data-target="' + id + '"]');
            if (!startInput || !endInput) return;
            var s = startInput.value, en = endInput.value;
            if (s && en && s >= en) {
                e.preventDefault();
                hasError = true;
                endInput.focus();
                endInput.setCustomValidity('Jam tutup harus setelah jam buka.');
                endInput.reportValidity();
            }
        });
        if (hasError) return;

        // Prevent double submit
        if (_submitBusy) {
            e.preventDefault();
            alert('Perubahan sedang disimpan, mohon tunggu sebentar.');
            return;
        }
        _submitBusy = true;

        // Disable all submit buttons with feedback
        document.querySelectorAll('button[form="form-jam"], #form-jam button[type="submit"]').forEach(function (btn) {
            btn.disabled = true;
            btn.textContent = 'Menyimpan…';
        });
    });
})();
</script>
@endsection
