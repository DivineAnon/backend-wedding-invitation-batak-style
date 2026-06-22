@extends('Admin.Layouts.Admin')

@section('title', 'Edit Renungan')
@section('page_title', 'Edit Renungan')
@section('breadcrumb', 'Konten / Renungan / Edit')

@section('styles')
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet" />
    <style>
        .ql-container {
            font-family: var(--font);
            font-size: 14px;
            border-radius: 0 0 var(--radius) var(--radius) !important;
            border-color: var(--border) !important;
            background: var(--bg);
        }

        .ql-toolbar {
            border-radius: var(--radius) var(--radius) 0 0 !important;
            border-color: var(--border) !important;
            background: var(--bg);
        }

        .ql-editor {
            min-height: 400px;
            color: var(--accent);
        }

        .ql-editor.ql-blank::before {
            color: var(--muted);
            font-style: normal;
        }
    </style>
@endsection

@section('content')
    <form id="renungan-form" action="{{ route('admin.renungan.update', $renungan) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div style="display:grid;grid-template-columns:1fr 300px;gap:24px;align-items:start">

            {{-- Main column --}}
            <div>
                <div class="card">
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="judul">Judul Renungan</label>
                            <input type="text" id="judul" name="judul"
                                class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}"
                                value="{{ old('judul', $renungan->judul) }}" required>
                            @error('judul')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="kutipan">Kutipan Kitab Suci <span
                                    style="font-weight:400;color:var(--muted)">(opsional)</span></label>
                            <input type="text" id="kutipan" name="kutipan"
                                class="form-control {{ $errors->has('kutipan') ? 'is-invalid' : '' }}"
                                value="{{ old('kutipan', $renungan->kutipan) }}"
                                placeholder="Contoh: &quot;Kasihilah satu sama lain.&quot; — Yoh 13:34">
                            @error('kutipan')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="penulis">Dibuat Oleh <span
                                    style="font-weight:400;color:var(--muted)">(opsional)</span></label>
                            <input type="text" id="penulis" name="penulis"
                                class="form-control {{ $errors->has('penulis') ? 'is-invalid' : '' }}"
                                value="{{ old('penulis', $renungan->penulis) }}" placeholder="Nama penulis renungan…">
                            @error('penulis')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="quill-editor">Isi Renungan</label>
                            <div id="quill-editor"></div>
                            <textarea id="isi" name="isi" style="display:none">{{ old('isi', $renungan->isi) }}</textarea>
                            @error('isi')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
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
                            <label class="form-label" for="status">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="draft" {{ old('status', $renungan->status) === 'draft' ? 'selected' : '' }}>
                                    Draft</option>
                                <option value="published"
                                    {{ old('status', $renungan->status) === 'published' ? 'selected' : '' }}>Publish
                                </option>
                            </select>
                            @if (!auth('admin')->user()->hasPermission('renungan', 'publish') && $renungan->status === 'published')
                                <p style="font-size:11px;color:var(--muted);margin-top:4px;">⚠️ Status published hanya bisa diubah ke <strong>Draft</strong>. Tombol Simpan aktif setelah perubahan.</p>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-full" id="submitBtn">Perbarui</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header"><span class="card__title">Tema / Topik</span></div>
                    <div class="card__body">
                        <div class="form-group" style="margin-bottom:0">
                            <input type="text" id="tema" name="tema"
                                class="form-control {{ $errors->has('tema') ? 'is-invalid' : '' }}"
                                value="{{ old('tema', $renungan->tema) }}" placeholder="Misal: Kasih, Doa, Pengampunan…">
                            @error('tema')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header"><span class="card__title">Media Ilustrasi</span></div>
                    <div class="card__body">
                        @php
                            $currentMedia = $renungan->video ? 'video' : ($renungan->gambar ? 'gambar' : '');
                            $oldMedia = old('media_type', $currentMedia);
                        @endphp
                        <div class="form-group">
                            <label class="form-label">Jenis Media</label>
                            <div style="display:flex;gap:8px;margin-bottom:12px;">
                                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:13px;">
                                    <input type="radio" name="media_type" value="" {{ $oldMedia === '' ? 'checked' : '' }} onchange="toggleMedia(this.value)"> Tidak ada
                                </label>
                                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:13px;">
                                    <input type="radio" name="media_type" value="gambar" {{ $oldMedia === 'gambar' ? 'checked' : '' }} onchange="toggleMedia(this.value)"> Gambar
                                </label>
                                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:13px;">
                                    <input type="radio" name="media_type" value="video" {{ $oldMedia === 'video' ? 'checked' : '' }} onchange="toggleMedia(this.value)"> Video
                                </label>
                            </div>
                        </div>

                        <div id="wrap-gambar" style="display:{{ $oldMedia === 'gambar' ? 'block' : 'none' }}">
                            <div class="form-group" style="margin-bottom:0">
                                <label class="form-label" for="gambar">Upload Gambar</label>
                                @if ($renungan->gambar)
                                    <div style="margin-bottom:8px;">
                                        <img src="{{ media_url($renungan->gambar, 'compro_assets/image/renungan') }}"
                                            alt="" class="img-preview" />
                                        <div style="font-size:11px;color:var(--muted);margin-top:4px;">Gambar saat ini. Upload baru untuk mengganti.</div>
                                    </div>
                                @endif
                                <input type="file" id="gambar" name="gambar" accept="image/*"
                                    class="form-control {{ $errors->has('gambar') ? 'is-invalid' : '' }}"
                                    onchange="previewImg(this)">
                                @error('gambar')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                                <p style="font-size:11px;color:var(--muted);margin-top:4px;">JPG, PNG, WEBP. Maks 50 MB.</p>
                                <div id="img-preview-wrap" style="display:none;margin-top:10px">
                                    <img id="img-preview" src="" alt="preview" class="img-preview" />
                                </div>
                            </div>
                        </div>

                        <div id="wrap-video" style="display:{{ $oldMedia === 'video' ? 'block' : 'none' }}">
                            <div class="form-group" style="margin-bottom:0">
                                <label class="form-label" for="video">Upload Video</label>
                                @if ($renungan->video)
                                    <div style="margin-bottom:8px;">
                                        <video controls style="width:100%;border-radius:6px;max-height:200px;">
                                            <source src="{{ media_url($renungan->video, 'compro_assets/media/renungan') }}">
                                        </video>
                                        <div style="font-size:11px;color:var(--muted);margin-top:4px;">Video saat ini. Upload baru untuk mengganti.</div>
                                    </div>
                                @endif
                                <input type="file" id="video" name="video" accept="video/mp4,video/webm,video/ogg,video/quicktime"
                                    class="form-control {{ $errors->has('video') ? 'is-invalid' : '' }}"
                                    onchange="previewVid(this)">
                                @error('video')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                                <p style="font-size:11px;color:var(--muted);margin-top:4px;">MP4, WEBM, MOV, OGG. Maks 50 MB.</p>
                                <div id="vid-preview-wrap" style="display:none;margin-top:10px">
                                    <video id="vid-preview" controls style="width:100%;border-radius:6px;max-height:200px;"></video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.renungan.index') }}" class="btn btn-secondary btn-full">Batal</a>

                @if (auth('admin')->user()->hasPermission('renungan', 'delete'))
                    <button type="button" class="btn btn-danger btn-full"
                        onclick="document.getElementById('modal-del').style.display='flex'">Hapus Renungan</button>
                @else
                    <button type="button" class="btn btn-danger btn-full" disabled
                        title="Anda tidak memiliki izin untuk menghapus renungan">Hapus Renungan</button>
                @endif
            </div>
        </div>
    </form>

    {{-- Delete Modal --}}
    <div id="modal-del"
        style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;backdrop-filter:blur(2px)">
        <div
            style="background:#ffffff;border:1px solid #e0e0e0;border-radius:var(--radius);padding:32px;width:100%;max-width:420px;margin:16px;color:#333;box-shadow:0 20px 40px rgba(0,0,0,0.2);animation:slideUp 0.3s ease">
            <h3 style="margin:0 0 8px;font-size:18px;font-weight:600;color:#333">Hapus Renungan</h3>
            <p style="margin:0 0 24px;font-size:14px;color:#666;line-height:1.5">Apakah Anda yakin ingin menghapus
                "<strong style="color:#333">{{ $renungan->judul }}</strong>"? Tindakan ini tidak dapat dibatalkan.</p>
            <div style="display:flex;gap:12px;justify-content:flex-end">
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('modal-del').style.display='none'" style="flex:1">Batal</button>
                <form id="form-delete-renungan" action="{{ route('admin.renungan.destroy', $renungan) }}" method="POST" style="flex:1">
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
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        const quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Tulis isi renungan di sini...',
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, 3, false]
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        list: 'ordered'
                    }, {
                        list: 'bullet'
                    }],
                    ['blockquote', 'code-block'],
                    ['link'],
                    [{
                        align: []
                    }],
                    ['clean']
                ]
            }
        });

        const isiVal = document.getElementById('isi').value;
        if (isiVal) quill.clipboard.dangerouslyPasteHTML(isiVal);

        document.getElementById('renungan-form').addEventListener('submit', function(e) {
            const html = quill.root.innerHTML;
            const text = quill.getText().trim();
            document.getElementById('isi').value = text.length > 0 ? html : '';
        });

        // Handle button disable/enable berdasarkan status change
        const canPublish = {{ auth('admin')->user()->hasPermission('renungan', 'publish') ? 'true' : 'false' }};
        const currentStatus = '{{ $renungan->status }}';
        const statusSelect = document.getElementById('status');
        const submitBtn = document.getElementById('submitBtn');

        function updateButtonState() {
            if (!canPublish && currentStatus === 'published') {
                if (statusSelect.value === 'draft') {
                    submitBtn.disabled = false;
                    submitBtn.title = '';
                } else {
                    submitBtn.disabled = true;
                    submitBtn.title = 'Anda tidak bisa mengubah renungan yang dipublikasikan tanpa permission';
                }
            }
        }

        statusSelect.addEventListener('change', updateButtonState);
        updateButtonState();

        function previewImg(input) {
            if (input.files && input.files[0]) {
                const wrap = document.getElementById('img-preview-wrap');
                const img  = document.getElementById('img-preview');
                img.src = URL.createObjectURL(input.files[0]);
                wrap.style.display = 'block';
            }
        }

        function previewVid(input) {
            if (input.files && input.files[0]) {
                const wrap  = document.getElementById('vid-preview-wrap');
                const video = document.getElementById('vid-preview');
                video.src = URL.createObjectURL(input.files[0]);
                wrap.style.display = 'block';
            }
        }

        function toggleMedia(val) {
            document.getElementById('wrap-gambar').style.display = val === 'gambar' ? 'block' : 'none';
            document.getElementById('wrap-video').style.display  = val === 'video'  ? 'block' : 'none';
            if (val !== 'gambar') { const g = document.getElementById('gambar'); if(g) g.value = ''; }
            if (val !== 'video')  { const v = document.getElementById('video');  if(v) v.value = ''; }
        }

        const initMedia = document.querySelector('input[name="media_type"]:checked');
        if (initMedia) toggleMedia(initMedia.value);
    </script>
@endsection
