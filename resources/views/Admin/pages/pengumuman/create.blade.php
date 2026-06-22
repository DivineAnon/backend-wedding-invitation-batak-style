@extends('Admin.Layouts.Admin')

@section('title', 'Tambah Pengumuman')
@section('page_title', 'Tambah Pengumuman')
@section('breadcrumb', 'Konten / Pengumuman / Tambah')

@section('content')
    <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="admin-form-grid">

            {{-- Main column --}}
            <div>
                <div class="card">
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="judul">Judul Pengumuman</label>
                            <input type="text" id="judul" name="judul"
                                class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}"
                                value="{{ old('judul') }}" placeholder="Tulis judul pengumuman…" required autofocus>
                            @error('judul')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="kategori">Kategori</label>
                            <input type="text" id="kategori" name="kategori" list="kategori-list"
                                class="form-control {{ $errors->has('kategori') ? 'is-invalid' : '' }}"
                                value="{{ old('kategori') }}" placeholder="mis. Jadwal Misa, Kegiatan…" required>
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
                                class="form-control {{ $errors->has('isi') ? 'is-invalid' : '' }}" placeholder="Tulis isi pengumuman di sini…"
                                required>{{ old('isi') }}</textarea>
                            @error('isi')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" style="margin-top:20px;margin-bottom:0">
                            <label class="form-label" for="foto">Foto (opsional)</label>
                            <input type="file" id="foto" name="foto" accept="image/jpg,image/jpeg,image/png,image/webp"
                                class="form-control {{ $errors->has('foto') ? 'is-invalid' : '' }}"
                                onchange="previewFoto(this)">
                            @error('foto')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                            <div id="foto-preview" style="display:none;margin-top:10px">
                                <img id="foto-preview-img" src="" alt="Preview" style="max-width:100%;max-height:240px;border-radius:var(--radius);border:1px solid var(--border)">
                            </div>
                            <p style="font-size:11px;color:var(--muted);margin-top:4px">Format: JPG, PNG, WebP. Maks 2 MB.</p>
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
                                value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="is_active">Status</label>
                            @if (auth('admin')->user()->hasPermission('pengumuman', 'activate'))
                                <select id="is_active" name="is_active" class="form-control">
                                    <option value="1" {{ old('is_active', '1') === '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('is_active', '0') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            @else
                                <input type="hidden" name="is_active" value="0" />
                                <div class="form-control" style="background:var(--bg-secondary);border:1px solid var(--border);border-radius:var(--radius);padding:8px 12px;color:var(--muted);cursor:not-allowed;pointer-events:none;opacity:0.6">
                                    <strong>Nonaktif</strong> (default, tidak bisa diubah)
                                </div>
                                <p style="font-size:11px;color:var(--muted);margin-top:4px;">⚠️ Anda tidak memiliki izin untuk mengaktifkan pengumuman. Pengumuman akan disimpan sebagai <strong>Nonaktif</strong>.</p>
                            @endif
                        </div>

                        <div class="form-group" style="margin-bottom:0">
                            <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                                <input type="checkbox" name="is_pinned" value="1"
                                    {{ old('is_pinned') ? 'checked' : '' }}
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

                        <div style="margin-top:20px">
                            <button type="submit" class="btn btn-primary btn-full">Simpan Pengumuman</button>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary btn-full">Batal</a>
            </div>

        </div>
    </form>
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
</script>
@endsection