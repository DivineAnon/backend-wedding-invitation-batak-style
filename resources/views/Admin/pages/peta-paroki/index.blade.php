@extends('Admin.Layouts.Admin')

@section('title', 'Peta Paroki')
@section('page_title', 'Peta Paroki')
@section('breadcrumb', 'Konten / Peta Paroki')

@section('topbar_actions')
    <a href="{{ route('admin.peta-paroki.edit') }}" class="btn btn-primary">Edit Peta Paroki</a>
@endsection

@section('content')
    {{-- Hero Image --}}
    @if ($peta->hero_image)
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Hero Image</div>
            </div>
            <div class="card__body">
                <img src="{{ media_url($peta->hero_image, 'assets/peta-paroki') }}" alt="Hero"
                    style="width:260px;height:140px;object-fit:cover;border-radius:6px;border:1px solid var(--border);" />
                <p style="font-size:12px;color:var(--muted);margin-top:8px;">
                    File: {{ $peta->hero_image }}
                </p>
            </div>
        </div>
    @endif

    {{-- Gambar peta --}}
    @if ($peta->gambar)
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Gambar Peta</div>
            </div>
            <div class="card__body">
                <img src="{{ media_url($peta->gambar, 'compro_assets/image') }}" alt="Peta Paroki"
                    style="max-width:400px;width:100%;border-radius:6px;border:1px solid var(--border);" />
                <p style="font-size:12px;color:var(--muted);margin-top:8px;">File: {{ $peta->gambar }}</p>
            </div>
        </div>
    @endif

    {{-- Informasi --}}
    <div class="card" style="margin-bottom:20px;">
        <div class="card__header">
            <div class="card__title">Informasi Kontak</div>
        </div>
        <div class="card__body" style="padding:0;">
            <table class="table">
                <tbody>
                    <tr>
                        <td style="width:180px;color:var(--muted);">Alamat</td>
                        <td>{{ $peta->alamat }}</td>
                    </tr>
                    <tr>
                        <td style="color:var(--muted);">Kota</td>
                        <td>{{ $peta->kota }}</td>
                    </tr>
                    <tr>
                        <td style="color:var(--muted);">Telepon</td>
                        <td>{{ $peta->telepon }}</td>
                    </tr>
                    <tr>
                        <td style="color:var(--muted);">Faks</td>
                        <td>{{ $peta->faks }}</td>
                    </tr>
                    <tr>
                        <td style="color:var(--muted);">Email</td>
                        <td>{{ $peta->email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Jam Pelayanan --}}
    <div class="card" style="margin-bottom:20px;">
        <div class="card__header">
            <div class="card__title">Jam Pelayanan</div>
        </div>
        <div class="card__body" style="padding:0;">
            <table class="table">
                <tbody>
                    <tr>
                        <td style="width:180px;color:var(--muted);">Senin — Jumat</td>
                        <td>{{ $peta->jam_senin_jumat }}</td>
                    </tr>
                    <tr>
                        <td style="color:var(--muted);">Sabtu</td>
                        <td>{{ $peta->jam_sabtu }}</td>
                    </tr>
                    <tr>
                        <td style="color:var(--muted);">Minggu</td>
                        <td>{{ $peta->jam_minggu }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @if ($peta->catatan_pelayanan)
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Catatan Pelayanan</div>
            </div>
            <div class="card__body">
                <p style="line-height:1.7;">{{ $peta->catatan_pelayanan }}</p>
            </div>
        </div>
    @endif

    {{-- Maps embed --}}
    @if ($peta->maps_embed_url)
        <div class="card">
            <div class="card__header">
                <div class="card__title">Google Maps Embed URL</div>
            </div>
            <div class="card__body">
                <p style="font-size:12px;color:var(--muted);word-break:break-all;">{{ $peta->maps_embed_url }}</p>
            </div>
        </div>
    @endif
@endsection
