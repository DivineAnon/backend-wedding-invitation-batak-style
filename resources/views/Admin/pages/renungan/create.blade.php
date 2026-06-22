@extends('Admin.Layouts.Admin')

@section('title', 'Tulis Renungan')
@section('page_title', 'Tulis Renungan')
@section('breadcrumb', 'Konten / Renungan / Tambah')

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
    <form id="renungan-form" action="{{ route('admin.renungan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 300px;gap:24px;align-items:start">

            {{-- Main column --}}
            <div>
                <div class="card">
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="judul">Judul Renungan</label>
                            <input type="text" id="judul" name="judul"
                                class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}"
                                value="{{ old('judul') }}" placeholder="Tulis judul renungan…" required autofocus>
                            @error('judul')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="kutipan">Kutipan Kitab Suci <span
                                    style="font-weight:400;color:var(--muted)">(opsional)</span></label>
                            <input type="text" id="kutipan" name="kutipan"
                                class="form-control {{ $errors->has('kutipan') ? 'is-invalid' : '' }}"
                                value="{{ old('kutipan') }}"
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
                                value="{{ old('penulis') }}" placeholder="Nama penulis renungan…">
                            @error('penulis')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="quill-editor">Isi Renungan</label>
                            <div id="quill-editor"></div>
                            <textarea id="isi" name="isi" style="display:none">{{ old('isi') }}</textarea>
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
                            @if (auth('admin')->user()->hasPermission('renungan', 'publish'))
                                <select id="status" name="status" class="form-control">
                                    <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft
                                    </option>
                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Publish
                                    </option>
                                </select>
                            @else
                                <input type="hidden" name="status" value="draft" />
                                <div class="form-control" style="background:var(--bg-secondary);border:1px solid var(--border);border-radius:var(--radius);padding:8px 12px;color:var(--muted);cursor:not-allowed;opacity:0.6">
                                    <strong>Draft</strong> (default, tidak bisa diubah)
                                </div>
                                <p style="font-size:11px;color:var(--muted);margin-top:4px;">⚠️ Anda tidak memiliki izin mempublikasikan renungan.</p>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-full">Simpan</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header"><span class="card__title">Tema / Topik</span></div>
                    <div class="card__body">
                        <div class="form-group" style="margin-bottom:0">
                            <input type="text" id="tema" name="tema"
                                class="form-control {{ $errors->has('tema') ? 'is-invalid' : '' }}"
                                value="{{ old('tema') }}" placeholder="Misal: Kasih, Doa, Pengampunan…">
                            <div style="font-size:11px;color:var(--muted);margin-top:6px">Topik singkat yang mewakili
                                renungan ini.</div>
                            @error('tema')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header"><span class="card__title">Media Ilustrasi</span></div>
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label">Jenis Media</label>
                            <div style="display:flex;gap:8px;margin-bottom:12px;">
                                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:13px;">
                                    <input type="radio" name="media_type" value="" id="media_none" {{ old('media_type', '') === '' ? 'checked' : '' }} onchange="toggleMedia(this.value)"> Tidak ada
                                </label>
                                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:13px;">
                                    <input type="radio" name="media_type" value="gambar" id="media_gambar" {{ old('media_type') === 'gambar' ? 'checked' : '' }} onchange="toggleMedia(this.value)"> Gambar
                                </label>
                                <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-size:13px;">
                                    <input type="radio" name="media_type" value="video" id="media_video" {{ old('media_type') === 'video' ? 'checked' : '' }} onchange="toggleMedia(this.value)"> Video
                                </label>
                            </div>
                        </div>

                        <div id="wrap-gambar" style="display:{{ old('media_type') === 'gambar' ? 'block' : 'none' }}">
                            <div class="form-group" style="margin-bottom:0">
                                <label class="form-label" for="gambar">Upload Gambar</label>
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

                        <div id="wrap-video" style="display:{{ old('media_type') === 'video' ? 'block' : 'none' }}">
                            <div class="form-group" style="margin-bottom:0">
                                <label class="form-label" for="video">Upload Video</label>
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
            </div>
        </div>
    </form>
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
            if (val !== 'gambar') document.getElementById('gambar').value = '';
            if (val !== 'video')  document.getElementById('video').value  = '';
        }

        // Init on load
        const initMedia = document.querySelector('input[name="media_type"]:checked');
        if (initMedia) toggleMedia(initMedia.value);
    </script>
@endsection
