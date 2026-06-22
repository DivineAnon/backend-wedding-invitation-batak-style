@extends('Admin.Layouts.Admin')

@section('title', 'Edit Jadwal Misa')
@section('page_title', 'Edit Jadwal Misa')
@section('breadcrumb', 'Pengaturan / Jadwal Misa / Edit')

@section('content')
    <form action="{{ route('admin.jadwal-misa.update', $jadwalMisa) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;">

            {{-- Main fields --}}
            <div class="card">
                <div class="card__header">
                    <div class="card__title">Informasi Jadwal</div>
                </div>
                <div class="card__body">
                    <div class="form-group">
                        <label class="form-label" for="hari_group">Kelompok Hari <span
                                style="color:var(--danger)">*</span></label>
                        <select name="hari_group" id="hari_group"
                            class="form-control {{ $errors->has('hari_group') ? 'is-invalid' : '' }}">
                            <option value="">— Pilih Hari —</option>
                            @foreach (\App\Models\JadwalMisa::HARI_GROUPS as $h)
                                <option value="{{ $h }}"
                                    {{ old('hari_group', $jadwalMisa->hari_group) === $h ? 'selected' : '' }}>
                                    {{ $h }}</option>
                            @endforeach
                        </select>
                        @error('hari_group')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="jam">Jam <span style="color:var(--danger)">*</span></label>
                        <input type="text" name="jam" id="jam" value="{{ old('jam', $jadwalMisa->jam) }}"
                            class="form-control {{ $errors->has('jam') ? 'is-invalid' : '' }}" placeholder="cth. 06.00" />
                        @error('jam')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" for="tipe">Tipe Misa <span
                                style="color:var(--danger)">*</span></label>
                        <select name="tipe" id="tipe"
                            class="form-control {{ $errors->has('tipe') ? 'is-invalid' : '' }}">
                            <option value="">— Pilih Tipe —</option>
                            @foreach (\App\Models\JadwalMisa::TIPE_OPTIONS as $t)
                                <option value="{{ $t }}"
                                    {{ old('tipe', $jadwalMisa->tipe) === $t ? 'selected' : '' }}>{{ $t }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipe')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Right sidebar --}}
            <div>
                <div class="card" style="margin-bottom:16px;">
                    <div class="card__header">
                        <div class="card__title">Urutan Tampil</div>
                    </div>
                    <div class="card__body">
                        <div class="form-group" style="margin:0;">
                            <input type="number" name="urutan" id="urutan"
                                value="{{ old('urutan', $jadwalMisa->urutan) }}" class="form-control" min="0" />
                            <p style="font-size:11px;color:var(--muted);margin-top:4px;">Angka kecil tampil lebih dahulu.
                            </p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">Perbarui</button>
                <a href="{{ route('admin.jadwal-misa.index') }}" class="btn btn-secondary"
                    style="width:100%;margin-top:8px;text-align:center;">Batal</a>
            </div>

        </div>
    </form>
@endsection
