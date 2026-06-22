@extends('Admin.Layouts.Admin')

@section('title', 'Tulis Berita')
@section('page_title', 'Tulis Berita')
@section('breadcrumb', 'Konten / Berita / Tambah')

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
            min-height: 420px;
            color: var(--accent);
        }

        .ql-editor.ql-blank::before {
            color: var(--muted);
            font-style: normal;
        }
    </style>
@endsection

@section('content')
    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 300px;gap:24px;align-items:start">

            {{-- Main column --}}
            <div>
                <div class="card">
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="judul">Judul Berita</label>
                            <input type="text" id="judul" name="judul"
                                class="form-control {{ $errors->has('judul') ? 'is-invalid' : '' }}"
                                value="{{ old('judul') }}" placeholder="Tulis judul yang menarik…" required autofocus>
                            @error('judul')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="ringkasan">Ringkasan (opsional)</label>
                            <textarea id="ringkasan" name="ringkasan" rows="2"
                                class="form-control {{ $errors->has('ringkasan') ? 'is-invalid' : '' }}"
                                placeholder="Deskripsi singkat yang tampil di card berita…">{{ old('ringkasan') }}</textarea>
                            @error('ringkasan')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="penulis">Penulis (opsional)</label>
                            <input type="text" id="penulis" name="penulis"
                                class="form-control {{ $errors->has('penulis') ? 'is-invalid' : '' }}"
                                value="{{ old('penulis') }}" placeholder="Nama penulis artikel…">
                            @error('penulis')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="quill-editor">Isi Berita</label>
                            <div id="quill-editor"></div>
                            <textarea id="isi" name="isi" style="display:none">{{ old('isi') }}</textarea>
                            @error('isi')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar column --}}
            <div style="display:flex;flex-direction:column;gap:16px">

                <div class="card">
                    <div class="card__header"><span class="card__title">Publikasi</span></div>
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="status">Status</label>
                            @if (auth('admin')->user()->hasPermission('berita', 'publish'))
                                <select id="status" name="status" class="form-control">
                                    <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft
                                    </option>
                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Publish
                                    </option>
                                </select>
                            @else
                                <input type="hidden" name="status" value="draft" />
                                <div class="form-control" style="background:var(--bg-secondary);border:1px solid var(--border);border-radius:var(--radius);padding:8px 12px;color:var(--muted);cursor:not-allowed;pointer-events:none;opacity:0.6">
                                    <strong>Draft</strong> (default, tidak bisa diubah)
                                </div>
                                <p style="font-size:11px;color:var(--muted);margin-top:4px;">⚠️ Anda tidak memiliki izin menerbitkan berita. Berita akan disimpan sebagai <strong>Draf</strong>.</p>
                            @endif
                        </div>
                        <div style="display:flex;gap:8px;margin-top:8px">
                            <button type="submit" class="btn btn-primary btn-full">Simpan</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header"><span class="card__title">Kategori</span></div>
                    <div class="card__body">
                        <div class="form-group" style="margin-bottom:0">
                            <select id="kategori_berita_id" name="kategori_berita_id"
                                class="form-control {{ $errors->has('kategori_berita_id') ? 'is-invalid' : '' }}" required>
                                <option value="">— Pilih kategori —</option>
                                @foreach ($kategoris as $kat)
                                    <option value="{{ $kat->id }}"
                                        {{ old('kategori_berita_id') == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_berita_id')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header"><span class="card__title">Cover Berita</span></div>
                    <div class="card__body">
                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label" for="cover">Upload Cover (opsional)</label>
                            <input type="file" id="cover" name="cover" accept="image/*"
                                class="form-control {{ $errors->has('cover') ? 'is-invalid' : '' }}"
                                onchange="previewCover(this)">
                            <small style="color:var(--muted)">Digunakan sebagai thumbnail di listing dan hero di halaman detail. JPG, PNG, WebP. Max 5MB.</small>
                            @error('cover')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                            <div id="cover-preview-wrap" style="display:none;margin-top:10px">
                                <img id="cover-preview" src="" alt="preview cover"
                                    style="width:100%;border-radius:var(--radius);object-fit:cover;max-height:180px" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header"><span class="card__title">Media Utama</span></div>
                    <div class="card__body">
                        {{-- Media Type Selection --}}
                        <div class="form-group" style="margin-bottom:16px">
                            <label class="form-label">Pilih Tipe Media</label>
                            <div style="display:flex;gap:12px;flex-wrap:wrap">
                                <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                                    <input type="radio" name="media_type" value="image" onchange="switchMediaType('image')" />
                                    <span>📷 Gambar</span>
                                </label>
                                <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                                    <input type="radio" name="media_type" value="video" onchange="switchMediaType('video')" />
                                    <span>🎥 Video</span>
                                </label>
                                <label style="display:flex;align-items:center;gap:8px;cursor:pointer">
                                    <input type="radio" name="media_type" value="youtube" onchange="switchMediaType('youtube')" />
                                    <span>▶️ YouTube Link</span>
                                </label>
                            </div>
                        </div>

                        {{-- Image Upload --}}
                        <div id="media-image" style="display:none">
                            <div class="form-group" style="margin-bottom:0">
                                <label class="form-label" for="gambar">Upload Gambar</label>
                                <input type="file" id="gambar" name="gambar" accept="image/*"
                                    class="form-control {{ $errors->has('gambar') ? 'is-invalid' : '' }}"
                                    onchange="previewImg(this)">
                                @error('gambar')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                                <div id="img-preview-wrap" style="display:none;margin-top:10px">
                                    <img id="img-preview" src="" alt="preview" class="img-preview" />
                                </div>
                            </div>
                        </div>

                        {{-- Video Upload --}}
                        <div id="media-video" style="display:none">
                            <div class="form-group" style="margin-bottom:0">
                                <label class="form-label" for="video">Upload Video</label>
                                <input type="file" id="video" name="video" accept="video/*"
                                    class="form-control {{ $errors->has('video') ? 'is-invalid' : '' }}">
                                <small style="color:var(--muted)">Max 100MB (MP4, WebM, Ogg, MOV)</small>
                                @error('video')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- YouTube URL --}}
                        <div id="media-youtube" style="display:none">
                            <div class="form-group" style="margin-bottom:0">
                                <label class="form-label" for="youtube_url">Link YouTube</label>
                                <input type="url" id="youtube_url" name="youtube_url"
                                    class="form-control {{ $errors->has('youtube_url') ? 'is-invalid' : '' }}"
                                    placeholder="https://www.youtube.com/watch?v=...">
                                <small style="color:var(--muted)">Paste link YouTube yang ingin ditampilkan</small>
                                @error('youtube_url')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary btn-full">Batal</a>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        const quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Tulis isi berita di sini...',
            modules: {
                toolbar: {
                    container: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['blockquote', 'code-block'],
                        ['link', 'image'],
                        [{ align: [] }],
                        ['clean']
                    ],
                    handlers: {
                        image: function () {
                            const input = document.createElement('input');
                            input.setAttribute('type', 'file');
                            input.setAttribute('accept', 'image/jpeg,image/png,image/webp,image/gif');
                            input.click();
                            input.onchange = async () => {
                                const file = input.files[0];
                                if (!file) return;
                                if (file.size > 5 * 1024 * 1024) {
                                    alert('Ukuran gambar maksimal 5 MB.');
                                    return;
                                }
                                const formData = new FormData();
                                formData.append('image', file);
                                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                                try {
                                    const res = await fetch('{{ route('admin.berita.upload-image') }}', {
                                        method: 'POST',
                                        body: formData,
                                    });
                                    const data = await res.json();
                                    if (!res.ok || data.error) {
                                        alert(data.error || 'Upload gagal.');
                                        return;
                                    }
                                    const range = quill.getSelection(true);
                                    quill.insertEmbed(range.index, 'image', data.url);
                                    quill.setSelection(range.index + 1);
                                } catch (e) {
                                    alert('Upload gagal. Periksa koneksi Anda.');
                                }
                            };
                        }
                    }
                }
            }
        });

        // Restore old value on validation error
        const isiVal = document.getElementById('isi').value;
        if (isiVal) quill.clipboard.dangerouslyPasteHTML(isiVal);

        // Sync realtime setiap kali Quill berubah
        quill.on('text-change', function() {
            document.getElementById('isi').value = quill.root.innerHTML;
        });

        // Sync juga saat submit sebagai backup
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('isi').value = quill.root.innerHTML;
        });

        function previewImg(input) {
            if (input.files && input.files[0]) {
                const wrap = document.getElementById('img-preview-wrap');
                const img = document.getElementById('img-preview');
                img.src = URL.createObjectURL(input.files[0]);
                wrap.style.display = 'block';
            }
        }

        function previewCover(input) {
            if (input.files && input.files[0]) {
                const wrap = document.getElementById('cover-preview-wrap');
                const img = document.getElementById('cover-preview');
                img.src = URL.createObjectURL(input.files[0]);
                wrap.style.display = 'block';
            }
        }

        function switchMediaType(type) {
            // Hide all media sections
            document.getElementById('media-image').style.display = 'none';
            document.getElementById('media-video').style.display = 'none';
            document.getElementById('media-youtube').style.display = 'none';

            // Show selected media type
            document.getElementById('media-' + type).style.display = 'block';

            // Clear other media inputs
            if (type !== 'image') {
                document.getElementById('gambar').value = '';
                document.getElementById('img-preview-wrap').style.display = 'none';
            }
            if (type !== 'video') {
                document.getElementById('video').value = '';
            }
            if (type !== 'youtube') {
                document.getElementById('youtube_url').value = '';
            }
        }
    </script>
@endsection
