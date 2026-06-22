@extends('Admin.Layouts.Admin')

@section('title', 'Hero Beranda')
@section('page_title', 'Hero Beranda')
@section('breadcrumb', 'Konten / Hero Beranda')

@section('topbar_actions')
    <a href="{{ route('admin.beranda.page.edit') }}" class="btn btn-secondary" style="margin-right:8px;">Edit Konten Halaman</a>
    <a href="{{ route('admin.beranda.edit') }}" class="btn btn-primary">Edit Hero</a>
@endsection

@section('content')
    {{-- Hero Preview --}}
    <div class="card" style="margin-bottom:20px;">
        <div class="card__header">
            <div class="card__title">Preview Gambar Hero</div>
        </div>
        <div class="card__body">
            <img src="{{ media_url($hero->hero_image, 'assets/beranda') }}" alt="Hero Beranda"
                style="width:100%;max-width:600px;height:240px;object-fit:cover;border-radius:6px;border:1px solid var(--border);" />
            <p style="font-size:12px;color:var(--muted);margin-top:8px;">File: {{ $hero->hero_image }}</p>
        </div>
    </div>

    {{-- Konten Hero --}}
    <div class="card">
        <div class="card__header">
            <div class="card__title">Konten Hero</div>
        </div>
        <div class="card__body" style="padding:0 24px;">
            <div class="detail-row">
                <div class="detail-row__label">Tagline</div>
                <div class="detail-row__value">{{ $hero->tagline }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-row__label">Judul Card</div>
                <div class="detail-row__value">{{ $hero->card_title }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-row__label">Deskripsi Card</div>
                <div class="detail-row__value" style="white-space:pre-line;">{{ $hero->card_desc }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-row__label">Teks Tombol</div>
                <div class="detail-row__value">{{ $hero->button_text }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-row__label">Link Tombol</div>
                <div class="detail-row__value">{{ $hero->button_link }}</div>
            </div>
        </div>
    </div>
@endsection
