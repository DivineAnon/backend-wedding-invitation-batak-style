@extends('Admin.Layouts.Admin')

@section('title', 'Edit Intensi Misa')
@section('page_title', 'Edit Intensi Misa')
@section('breadcrumb', 'Pelayanan / Intensi Misa / Edit')

@section('content')
    <div style="max-width:560px;">
        <form action="{{ route('admin.intensi-misa.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card__header">
                    <div class="card__title">Pengaturan WhatsApp</div>
                </div>
                <div class="card__body">
                    <p style="font-size:13px;color:var(--muted);margin-bottom:20px;">
                        Isi nomor WhatsApp dan pesan yang akan terisi otomatis saat umat mengklik <strong>Intensi Misa</strong>.
                    </p>

                    <div class="form-group">
                        <label class="form-label" for="nomor_wa">Nomor WhatsApp</label>
                        <input type="text" name="nomor_wa" id="nomor_wa"
                            value="{{ old('nomor_wa', $intensi->nomor_wa) }}"
                            class="form-control"
                            placeholder="cth. 6281234567890 (tanpa tanda + atau spasi)" />
                        <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                            Format internasional tanpa tanda + — cth. <code>6281234567890</code> untuk nomor Indonesia.
                        </p>
                        @error('nomor_wa')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" for="pesan">Pesan Default</label>
                        <textarea name="pesan" id="pesan" class="form-control" rows="5"
                            placeholder="cth. Halo, saya ingin mendaftarkan Intensi Misa.">{{ old('pesan', $intensi->pesan) }}</textarea>
                        <p style="font-size:11px;color:var(--muted);margin-top:4px;">
                            Pesan ini akan muncul otomatis di kolom chat WhatsApp umat.
                        </p>
                        @error('pesan')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div style="display:flex;gap:10px;margin-top:20px;">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.intensi-misa.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection
