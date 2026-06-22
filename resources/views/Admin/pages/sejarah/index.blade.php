@extends('Admin.Layouts.Admin')

@section('title', 'Sejarah')
@section('page_title', 'Sejarah')
@section('breadcrumb', 'Konten / Sejarah')

@section('topbar_actions')
    <a href="{{ route('admin.sejarah.edit') }}" class="btn btn-primary">
        Edit Sejarah
    </a>
@endsection

@section('content')
    {{-- Hero preview --}}
    <div class="card" style="margin-bottom:20px;">
        <div class="card__header">
            <div class="card__title">Hero Image</div>
        </div>
        <div class="card__body">
            <img src="{{ media_url($sejarah->hero_image, 'assets/sejarah') }}" alt="Hero"
                style="width:260px;height:140px;object-fit:cover;border-radius:6px;border:1px solid var(--border);" />
            <p style="font-size:12px;color:var(--muted);margin-top:8px;">
                File: {{ $sejarah->hero_image }}
            </p>
        </div>
    </div>

    {{-- Info utama --}}
    <div class="card" style="margin-bottom:20px;">
        <div class="card__header">
            <div class="card__title">Informasi Utama</div>
        </div>
        <div class="card__body" style="padding:0 24px;">
            <div class="detail-row">
                <div class="detail-row__label">Accent Text</div>
                <div class="detail-row__value">{{ $sejarah->accent_text }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-row__label">Label</div>
                <div class="detail-row__value">{{ $sejarah->label }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-row__label">Tahun</div>
                <div class="detail-row__value">{{ $sejarah->year }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-row__label">Sumber</div>
                <div class="detail-row__value">{{ $sejarah->source ?? '—' }}</div>
            </div>
        </div>
    </div>

    {{-- Narasi --}}
    <div class="card" style="margin-bottom:20px;">
        <div class="card__header">
            <div class="card__title">Narasi ({{ count($sejarah->body) }} paragraf)</div>
        </div>
        <div class="card__body">
            @foreach ($sejarah->body as $i => $para)
                <p style="font-size:13px;margin-bottom:12px;line-height:1.7;">
                    <strong style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.04em;">
                        P{{ $i + 1 }}
                    </strong><br />
                    {{ $para }}
                </p>
            @endforeach
        </div>
    </div>

    {{-- Tonggak sejarah --}}
    <div class="card">
        <div class="card__header">
            <div class="card__title">Tonggak Sejarah ({{ $sejarah->milestones->count() }})</div>
        </div>
        <div class="card__body">
            <div class="milestone-list">
                @forelse ($sejarah->milestones as $ms)
                    <div class="milestone-item">
                        <span class="milestone-item__year">{{ $ms->tahun }}</span>
                        <div class="milestone-item__body">
                            <div class="milestone-item__title">{{ $ms->judul }}</div>
                            <div class="milestone-item__text">{{ $ms->deskripsi }}</div>
                        </div>
                    </div>
                @empty
                    <p style="font-size:13px;color:var(--muted);">Belum ada tonggak sejarah.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
