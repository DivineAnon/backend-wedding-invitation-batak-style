@extends('Admin.Layouts.Admin')

@section('title', 'Visi & Misi')
@section('page_title', 'Visi & Misi')
@section('breadcrumb', 'Konten / Visi & Misi')

@section('topbar_actions')
    <a href="{{ route('admin.visi-misi.edit') }}" class="btn btn-primary">Edit Visi &amp; Misi</a>
@endsection

@section('content')
    {{-- Hero preview --}}
    @if ($visiMisi->hero_image)
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Hero Image</div>
            </div>
            <div class="card__body">
                <img src="{{ media_url($visiMisi->hero_image, 'assets/visi-misi') }}" alt="Hero"
                    style="width:260px;height:140px;object-fit:cover;border-radius:6px;border:1px solid var(--border);" />
                <p style="font-size:12px;color:var(--muted);margin-top:8px;">
                    File: {{ $visiMisi->hero_image }}
                </p>
            </div>
        </div>
    @endif

    {{-- Visi --}}
    <div class="card" style="margin-bottom:20px;">
        <div class="card__header">
            <div class="card__title">Visi</div>
        </div>
        <div class="card__body">
            <p style="line-height:1.7;">{{ $visiMisi->visi }}</p>
        </div>
    </div>

    {{-- Misi --}}
    <div class="card" style="margin-bottom:20px;">
        <div class="card__header">
            <div class="card__title">Misi — Intro</div>
        </div>
        <div class="card__body">
            <p style="line-height:1.7;">{{ $visiMisi->misi_intro }}</p>
        </div>
    </div>

    @if ($visiMisi->misi_pillars && count($visiMisi->misi_pillars))
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Pilar Misi</div>
            </div>
            <div class="card__body" style="padding:0;">
                <table class="table admin-table" id="tbl-visi-misi" data-title="Pilar Misi">
                    <thead>
                        <tr>
                            <th style="width:160px;">Nama Pilar</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visiMisi->misi_pillars as $pillar)
                            <tr>
                                <td><strong>{{ $pillar['nama'] }}</strong></td>
                                <td>{{ $pillar['deskripsi'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- Spiritualitas --}}
    @if ($visiMisi->spiritualitas)
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">Spiritualitas</div>
            </div>
            <div class="card__body">
                <p style="line-height:1.7;">{{ $visiMisi->spiritualitas }}</p>
            </div>
        </div>
    @endif

    {{-- Nilai-Nilai --}}
    @if ($visiMisi->nilai_nilai && count($visiMisi->nilai_nilai))
        <div class="card">
            <div class="card__header">
                <div class="card__title">Nilai-Nilai</div>
            </div>
            <div class="card__body">
                <ol style="margin:0;padding-left:20px;line-height:2;">
                    @foreach ($visiMisi->nilai_nilai as $nilai)
                        <li>{{ $nilai }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    @endif
@endsection
