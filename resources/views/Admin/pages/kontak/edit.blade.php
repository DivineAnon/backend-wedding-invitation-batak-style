@extends('Admin.Layouts.Admin')

@section('title', 'Edit Kontak')
@section('page_title', 'Edit Kontak')
@section('breadcrumb', 'Pengaturan / Kontak / Edit')

@section('content')
    <form action="{{ route('admin.kontak.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display:grid;grid-template-columns:1fr;gap:20px;">

            {{-- Informasi Dasar --}}
            <div>
                <div class="card" style="margin-bottom:20px;">
                    <div class="card__header">
                        <div class="card__title">Informasi Dasar</div>
                    </div>
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $kontak->alamat) }}"
                                class="form-control" placeholder="cth. Jl. Matraman Raya 127" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="alamat_sub">Kota / Kode Pos</label>
                            <input type="text" name="alamat_sub" id="alamat_sub"
                                value="{{ old('alamat_sub', $kontak->alamat_sub) }}" class="form-control"
                                placeholder="cth. Jakarta Timur, 13320" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="telp">Telepon</label>
                            <input type="text" name="telp" id="telp" value="{{ old('telp', $kontak->telp) }}"
                                class="form-control" placeholder="cth. (021) 858-3782" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="telp_sub">Fax</label>
                            <input type="text" name="telp_sub" id="telp_sub"
                                value="{{ old('telp_sub', $kontak->telp_sub) }}" class="form-control"
                                placeholder="cth. (021) 856-8417" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $kontak->email) }}"
                                class="form-control" placeholder="cth. info.sekre.sanyos@gmail.com" />
                            @error('email')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" for="email_sub">Label Email</label>
                            <input type="text" name="email_sub" id="email_sub"
                                value="{{ old('email_sub', $kontak->email_sub) }}" class="form-control"
                                placeholder="cth. Sekretariat Paroki" />
                        </div>
                        <div class="form-group" style="margin-top:12px;margin-bottom:0;">
                            <label class="form-label" for="whatsapp_no">Nomor WhatsApp</label>
                            <input type="text" name="whatsapp_no" id="whatsapp_no"
                                value="{{ old('whatsapp_no', $kontak->whatsapp_no) }}" class="form-control"
                                placeholder="cth. 628123456789" maxlength="20" />
                            <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                                Format: <strong>62XXXXXXXXXX</strong> atau <strong>08XXXXXXXXX</strong><br/>
                                ⚠️ Digit ke-2 harus 1-9 (tidak boleh 0 setelah 62/0). Contoh valid: 628123456789, 081234567890
                            </p>
                            @error('whatsapp_no')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Sosial Media --}}
                <div class="card" style="margin-bottom:20px;">
                    <div class="card__header">
                        <div class="card__title">Media Sosial & Link</div>
                    </div>
                    <div class="card__body">
                        <div class="form-group">
                            <label class="form-label" for="facebook_url">URL Facebook</label>
                            <input type="url" name="facebook_url" id="facebook_url"
                                value="{{ old('facebook_url', $kontak->facebook_url) }}" class="form-control"
                                placeholder="https://www.facebook.com/..." />
                            @error('facebook_url')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="instagram_url">URL Instagram</label>
                            <input type="url" name="instagram_url" id="instagram_url"
                                value="{{ old('instagram_url', $kontak->instagram_url) }}" class="form-control"
                                placeholder="https://www.instagram.com/..." />
                            @error('instagram_url')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" for="youtube_url">URL YouTube</label>
                            <input type="url" name="youtube_url" id="youtube_url"
                                value="{{ old('youtube_url', $kontak->youtube_url) }}" class="form-control"
                                placeholder="https://www.youtube.com/..." />
                            @error('youtube_url')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Maps --}}
                <div class="card" style="margin-bottom:20px;">
                    <div class="card__header">
                        <div class="card__title">Google Maps Embed</div>
                    </div>
                    <div class="card__body">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label" for="map_embed_src">URL src iframe Google Maps</label>
                            <textarea name="map_embed_src" id="map_embed_src" class="form-control" rows="3"
                                placeholder="https://maps.google.com/maps?q=...&output=embed">{{ old('map_embed_src', $kontak->map_embed_src) }}</textarea>
                            <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                                Masukkan nilai atribut <code>src</code> dari &lt;iframe&gt; Google Maps.
                            </p>
                        </div>
                    </div>
                </div>


                <div style="display:flex;gap:10px;">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('admin.kontak.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>

        </div>
    </form>
@endsection

@section('scripts')
    <script>
        // Validasi WhatsApp Number
        document.getElementById('whatsapp_no').addEventListener('input', function(e) {
            let val = e.target.value.replace(/\D/g, ''); // ambil hanya angka
            
            if (val.length === 0) {
                e.target.value = '';
                return;
            }

            // Jika dimulai dengan 0, ubah ke 62
            if (val.startsWith('0')) {
                val = '62' + val.substring(1);
            }
            
            // Validasi: tidak boleh punya 0 langsung setelah 62 atau 0 (cth: 620... atau 00...)
            if (val.startsWith('62') && val.length >= 3 && val[2] === '0') {
                // Hapus 0 di posisi ke-3
                val = val.substring(0, 2) + val.substring(3);
            }
            
            // Jika tidak dimulai dengan 62 atau 0, reject
            if (!val.startsWith('62') && !val.startsWith('0')) {
                e.target.value = '62';
                return;
            }

            e.target.value = val;
        });

        // Validasi saat blur (tinggal fokus)
        document.getElementById('whatsapp_no').addEventListener('blur', function(e) {
            let val = e.target.value.trim();
            
            if (val && !val.startsWith('62') && !val.startsWith('0')) {
                e.target.classList.add('is-invalid');
            } else {
                e.target.classList.remove('is-invalid');
            }
        });
    </script>
@endsection
