@extends('Admin.Layouts.Admin')

@section('title', 'Edit Pengumuman')
@section('page_title', 'Edit Pengumuman')
@section('breadcrumb', 'Konten / Pengumuman / Edit')

@section('content')
    <form action="{{ route('admin.pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="admin-form-grid">

            {{-- Main column --}}
            <div>
                <div class="card">
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="judul">Judul Pengumuman</label>
                            <input type="text" id="judul" name="judul"
                                class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}"
                                value="{{ old('judul', $pengumuman->judul) }}" required autofocus>
                            @error('judul')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="kategori">Kategori</label>
                            <input type="text" id="kategori" name="kategori" list="kategori-list"
                                class="form-control {{ $errors->has('kategori') ? 'is-invalid' : '' }}"
                                value="{{ old('kategori', $pengumuman->kategori) }}" required>
                            <datalist id="kategori-list">
                                @foreach (\App\Models\Pengumuman::KATEGORI_PILIHAN as $kat)
                                    <option value="{{ $kat }}">
                                @endforeach
                            </datalist>
                            @error('kategori')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label" for="isi">Isi Pengumuman</label>
                            <textarea id="isi" name="isi" rows="10"
                                class="form-control {{ $errors->has('isi') ? 'is-invalid' : '' }}" required>{{ old('isi', $pengumuman->isi) }}</textarea>
                            @error('isi')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" style="margin-top:20px;margin-bottom:0">
                            <label class="form-label" for="foto">Foto (opsional)</label>
                            @if ($pengumuman->foto)
                                <div id="current-foto" style="margin-bottom:10px">
                                    <img src="{{ media_url($pengumuman->foto, 'assets') }}" alt="Foto pengumuman"
                                        style="max-width:100%;max-height:200px;border-radius:var(--radius);border:1px solid var(--border)">
                                    <div style="margin-top:6px">
                                        <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:12px;color:var(--muted)">
                                            <input type="checkbox" name="hapus_foto" value="1" id="hapus_foto"
                                                onchange="toggleHapusFoto(this)"
                                                style="width:14px;height:14px;accent-color:var(--danger,#e53e3e)">
                                            Hapus foto ini
                                        </label>
                                    </div>
                                </div>
                            @endif
                            <input type="file" id="foto" name="foto" accept="image/jpg,image/jpeg,image/png,image/webp"
                                class="form-control {{ $errors->has('foto') ? 'is-invalid' : '' }}"
                                onchange="previewFoto(this)">
                            @error('foto')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                            <div id="foto-preview" style="display:none;margin-top:10px">
                                <img id="foto-preview-img" src="" alt="Preview" style="max-width:100%;max-height:240px;border-radius:var(--radius);border:1px solid var(--border)">
                            </div>
                            <p style="font-size:11px;color:var(--muted);margin-top:4px">Format: JPG, PNG, WebP. Maks 2 MB. Upload foto baru akan menggantikan foto lama.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div style="display:flex;flex-direction:column;gap:16px">
                <div class="card">
                    <div class="card__header"><span class="card__title">Publikasi</span></div>
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="tanggal">Tanggal Pengumuman</label>
                            <input type="date" id="tanggal" name="tanggal"
                                class="form-control {{ $errors->has('tanggal') ? 'is-invalid' : '' }}"
                                value="{{ old('tanggal', $pengumuman->tanggal->format('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="is_active">Status</label>
                            <select id="is_active" name="is_active" class="form-control">
                                <option value="1"
                                    {{ old('is_active', $pengumuman->is_active ? '1' : '0') === '1' ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="0"
                                    {{ old('is_active', $pengumuman->is_active ? '1' : '0') === '0' ? 'selected' : '' }}>
                                    Nonaktif</option>
                            </select>
                            @if (!auth('admin')->user()->hasPermission('pengumuman', 'activate') && $pengumuman->is_active)
                                <p style="font-size:11px;color:var(--muted);margin-top:4px;">⚠️ Status aktif hanya bisa diubah ke <strong>Nonaktif</strong>. Tombol Simpan akan aktif setelah perubahan.</p>
                            @endif
                        </div>

                        <div class="form-group" style="margin-bottom:0">
                            <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                                <input type="checkbox" name="is_pinned" value="1"
                                    {{ old('is_pinned', $pengumuman->is_pinned) ? 'checked' : '' }}
                                    style="width:16px;height:16px;flex-shrink:0;accent-color:var(--accent)">
                                <span class="form-label"
                                    style="margin:0;text-transform:none;letter-spacing:0;font-size:13px">
                                    Sematkan (tampil di bagian "<strong>Now</strong>")
                                </span>
                            </label>
                            <p style="font-size:11px;color:var(--muted);margin-top:6px">
                                Item yang disematkan ditampilkan di bagian paling atas halaman pengumuman, terpisah dari
                                arsip per-tahun.
                            </p>
                        </div>

                        <div style="margin-top:20px;display:flex;gap:8px">
                            <button type="submit" class="btn btn-primary btn-full" id="submitBtn">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card__body" style="padding:16px">
                        <button type="button" class="btn btn-danger btn-full"
                            {{ !auth('admin')->user()->hasPermission('pengumuman', 'delete') ? 'disabled' : '' }}
                            title="{{ !auth('admin')->user()->hasPermission('pengumuman', 'delete') ? 'Anda tidak memiliki izin untuk menghapus pengumuman' : '' }}"
                            onclick="document.getElementById('modal-del').style.display='flex'">Hapus
                            Pengumuman</button>
                    </div>
                </div>

                <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary btn-full">Kembali</a>
            </div>

        </div>
    </form>

    {{-- Delete form is intentionally OUTSIDE the update form to avoid nested-form conflicts --}}
    {{-- Delete Modal --}}
    <div id="modal-del"
        style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;backdrop-filter:blur(2px)">
        <div
            style="background:#ffffff;border:1px solid #e0e0e0;border-radius:var(--radius);padding:32px;width:100%;max-width:420px;margin:16px;color:#333;box-shadow:0 20px 40px rgba(0,0,0,0.2);animation:slideUp 0.3s ease">
            <h3 style="margin:0 0 8px;font-size:18px;font-weight:600;color:#333">Hapus Pengumuman</h3>
            <p style="margin:0 0 24px;font-size:14px;color:#666;line-height:1.5">Apakah Anda yakin ingin menghapus
                "<strong style="color:#333">{{ $pengumuman->judul }}</strong>"? Tindakan ini tidak dapat dibatalkan.</p>
            <div style="display:flex;gap:12px;justify-content:flex-end">
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('modal-del').style.display='none'" style="flex:1">Batal</button>
                <form id="form-delete-pengumuman" action="{{ route('admin.pengumuman.destroy', $pengumuman) }}" method="POST" style="flex:1">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width:100%">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
    <style>
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection

@section('scripts')
    <script>
        function previewFoto(input) {
            const preview = document.getElementById('foto-preview');
            const img = document.getElementById('foto-preview-img');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => { img.src = e.target.result; preview.style.display = 'block'; };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
            }
        }

        function toggleHapusFoto(checkbox) {
            const currentFoto = document.getElementById('current-foto');
            if (checkbox.checked && currentFoto) {
                currentFoto.style.opacity = '0.4';
            } else if (currentFoto) {
                currentFoto.style.opacity = '1';
            }
        }

        // Handle button disable/enable berdasarkan is_active change
        const canActivate = {{ auth('admin')->user()->hasPermission('pengumuman', 'activate') ? 'true' : 'false' }};
        const currentIsActive = '{{ $pengumuman->is_active ? '1' : '0' }}';
        const isActiveSelect = document.getElementById('is_active');
        const submitBtn = document.getElementById('submitBtn');

        function updateButtonState() {
            if (!canActivate && currentIsActive === '1') {
                // User tanpa permission & status currently aktif
                if (isActiveSelect.value === '0') {
                    submitBtn.disabled = false;
                    submitBtn.title = '';
                } else {
                    submitBtn.disabled = true;
                    submitBtn.title = 'Anda tidak bisa mengubah pengumuman yang aktif tanpa permission';
                }
            }
        }

        isActiveSelect.addEventListener('change', updateButtonState);
        updateButtonState(); // Initialize state on page load
    </script>
@endsection
