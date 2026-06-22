@extends('Compro.Layouts.Compro')

@section('title', $pengumuman->judul)

@section('content')
    <section style="min-height: 100vh; display: flex; flex-direction: column; padding-top: 120px; padding-bottom: 80px;">
        <div style="max-width: 800px; width: 100%; margin: 0 auto; padding: 0 48px;">
            {{-- Breadcrumb --}}
            <div style="display: flex; gap: 8px; margin-bottom: 32px; font-size: 0.85rem;">
                <a href="{{ route('beranda') }}" style="color: rgba(255,255,255,0.5); text-decoration: none;">Beranda</a>
                <span style="color: rgba(255,255,255,0.3);">/</span>
                <a href="{{ route('artikel.pengumuman') }}" style="color: rgba(255,255,255,0.5); text-decoration: none;">Pengumuman</a>
                <span style="color: rgba(255,255,255,0.3);">/</span>
                <span style="color: rgba(255,255,255,0.7);">{{ Str::limit($pengumuman->judul, 40) }}</span>
            </div>

            {{-- Header --}}
            <div style="margin-bottom: 48px;">
                <div style="display: flex; gap: 12px; margin-bottom: 16px;">
                    <span style="font-size: 0.72rem; font-weight: 600; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.3);">{{ $pengumuman->kategori }}</span>
                    <span style="font-size: 0.72rem; color: rgba(255,255,255,0.3);">{{ $pengumuman->tanggal->translatedFormat('d F Y') }}</span>
                </div>
                <h1 style="font-family: 'Cinzel', Georgia, serif; font-size: 2.5rem; font-weight: 400; color: #fff; line-height: 1.3; margin: 0; margin-bottom: 24px;">
                    {{ $pengumuman->judul }}
                </h1>
            </div>

            {{-- Content --}}
            <article style="font-family: 'Chamberi', Georgia, serif; color: rgba(255,255,255,0.7); line-height: 1.85; font-size: 1.3rem; margin-bottom: 48px;">
                {!! nl2br(e($pengumuman->isi)) !!}
            </article>

            {{-- Related Pengumuman --}}
            @if ($related->isNotEmpty())
                <div style="margin-top: 64px; padding-top: 48px; border-top: 1px solid rgba(255,255,255,0.1);">
                    <h3 style="font-family: 'Cinzel', Georgia, serif; font-size: 1.3rem; font-weight: 400; color: #fff; margin: 0 0 32px;">Pengumuman Lainnya</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 32px;">
                        @foreach ($related as $p)
                            <a href="{{ route('artikel.pengumuman.show', $p->id) }}" 
                                style="display: flex; flex-direction: column; gap: 12px; text-decoration: none; color: inherit; padding: 16px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; transition: all 0.3s ease; background: rgba(255,255,255,0.02);"
                                onmouseover="this.style.borderColor='rgba(201, 168, 97, 0.3)'; this.style.background='rgba(201, 168, 97, 0.05)';"
                                onmouseout="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.background='rgba(255,255,255,0.02)';">
                                <span style="font-size: 0.72rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: rgba(255,255,255,0.4);">{{ $p->kategori }}</span>
                                <h4 style="font-family: 'Cinzel', Georgia, serif; font-size: 1rem; font-weight: 400; color: #fff; margin: 0; line-height: 1.4;">{{ $p->judul }}</h4>
                                <span style="font-size: 0.85rem; color: rgba(255,255,255,0.35); margin-top: 8px;">{{ $p->tanggal->translatedFormat('d F Y') }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Back Button --}}
            <div style="margin-top: 48px;">
                <a href="{{ route('artikel.pengumuman') }}" style="display: inline-block; padding: 12px 24px; border: 1px solid rgba(255,255,255,0.2); border-radius: 6px; color: rgba(255,255,255,0.7); text-decoration: none; transition: all 0.3s ease; font-style: italic;"
                    onmouseover="this.style.color='#fff'; this.style.borderColor='rgba(201, 168, 97, 0.5)';"
                    onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.borderColor='rgba(255,255,255,0.2)';">
                    ← Kembali ke Pengumuman
                </a>
            </div>
        </div>
    </section>
@endsection
