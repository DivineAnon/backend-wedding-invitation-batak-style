@extends('Admin.Layouts.Admin')

@section('title', 'Kontak')
@section('page_title', 'Kontak')
@section('breadcrumb', 'Pengaturan / Kontak')

@section('topbar_actions')
    <a href="{{ route('admin.kontak.page.edit') }}" class="btn btn-secondary" title="Edit hero image halaman kontak">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="1"></circle>
            <circle cx="19" cy="12" r="1"></circle>
            <circle cx="5" cy="12" r="1"></circle>
        </svg>
        Pengaturan Halaman
    </a>
    <a href="{{ route('admin.kontak.edit') }}" class="btn btn-primary">Edit Kontak</a>
@endsection

@section('content')
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(min(400px,100%),1fr));gap:20px;">

        {{-- Info Dasar --}}
        <div class="card">
            <div class="card__header">
                <div class="card__title">Informasi Dasar</div>
            </div>
            <div class="card__body">
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                        <td style="padding:6px 0;color:var(--muted);font-size:13px;width:130px;">Alamat</td>
                        <td style="padding:6px 0;font-size:13px;">{{ $kontak->alamat ?: '—' }}
                            @if ($kontak->alamat_sub)
                                <br><span style="color:var(--muted);">{{ $kontak->alamat_sub }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:6px 0;color:var(--muted);font-size:13px;">Telepon</td>
                        <td style="padding:6px 0;font-size:13px;">{{ $kontak->telp ?: '—' }}
                            @if ($kontak->telp_sub)
                                <br><span style="color:var(--muted);">{{ $kontak->telp_sub }} (Fax)</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:6px 0;color:var(--muted);font-size:13px;">Email</td>
                        <td style="padding:6px 0;font-size:13px;">{{ $kontak->email ?: '—' }}
                            @if ($kontak->email_sub)
                                <br><span style="color:var(--muted);">{{ $kontak->email_sub }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Sosial Media --}}
        <div class="card">
            <div class="card__header">
                <div class="card__title">Media Sosial</div>
            </div>
            <div class="card__body">
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                        <td style="padding:6px 0;color:var(--muted);font-size:13px;width:130px;">Facebook</td>
                        <td style="padding:6px 0;font-size:12px;word-break:break-all;">{{ $kontak->facebook_url ?: '—' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:6px 0;color:var(--muted);font-size:13px;">Instagram</td>
                        <td style="padding:6px 0;font-size:12px;word-break:break-all;">{{ $kontak->instagram_url ?: '—' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:6px 0;color:var(--muted);font-size:13px;">YouTube</td>
                        <td style="padding:6px 0;font-size:12px;word-break:break-all;">{{ $kontak->youtube_url ?: '—' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
@endsection
