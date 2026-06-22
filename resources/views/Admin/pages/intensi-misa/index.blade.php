@extends('Admin.Layouts.Admin')

@section('title', 'Intensi Misa')
@section('page_title', 'Intensi Misa')
@section('breadcrumb', 'Pelayanan / Intensi Misa')

@section('topbar_actions')
    <a href="{{ route('admin.intensi-misa.edit') }}" class="btn btn-primary">Edit Pengaturan</a>
@endsection

@section('content')
    <div style="max-width:600px;">
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Pengaturan WhatsApp Intensi Misa</div>
            </div>
            <div class="card__body">
                <p style="font-size:13px;color:var(--muted);margin-bottom:20px;">
                    Ketika umat mengklik menu <strong>Intensi Misa</strong> di website, mereka akan diarahkan ke WhatsApp
                    dengan nomor dan pesan di bawah ini.
                </p>
                <table style="width:100%;border-collapse:collapse;">
                    <tr>
                        <td style="padding:8px 0;color:var(--muted);font-size:13px;width:140px;vertical-align:top;">Nomor WhatsApp</td>
                        <td style="padding:8px 0;font-size:14px;font-weight:600;">
                            +{{ $intensi->nomor_wa ?: '—' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0;color:var(--muted);font-size:13px;vertical-align:top;">Pesan Default</td>
                        <td style="padding:8px 0;font-size:13px;line-height:1.6;white-space:pre-wrap;">{{ $intensi->pesan ?: '—' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card__header">
                <div class="card__title">Preview Link WhatsApp</div>
            </div>
            <div class="card__body">
                @php
                    $nomor = preg_replace('/[^0-9]/', '', $intensi->nomor_wa ?? '');
                    $pesan = urlencode($intensi->pesan ?? '');
                @endphp
                <p style="font-size:12px;color:var(--muted);margin-bottom:8px;">Link yang akan dibuka saat umat klik Intensi Misa:</p>
                <code style="font-size:11px;word-break:break-all;background:rgba(255,255,255,0.06);padding:8px 12px;border-radius:6px;display:block;line-height:1.6;">
                    https://wa.me/{{ $nomor }}?text={{ $pesan }}
                </code>
            </div>
        </div>
    </div>
@endsection
