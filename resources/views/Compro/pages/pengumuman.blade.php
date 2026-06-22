@extends('Compro.Layouts.Compro')

@section('title', 'Pengumuman — Paroki Mataram')

@section('content')
    <!-- Hero -->
    <section class="page-hero">
        @if ($pengumumanPage->hero_image)
            <img src="{{ media_url($pengumumanPage->hero_image, 'assets/pengumuman') }}" alt="" class="page-hero__bg" aria-hidden="true" />
        @else
            <div class="page-hero__bg"></div>
        @endif
        <div class="page-hero__content">
            <div class="page-hero__left">
                <span class="page-hero__eyebrow">Warta Paroki</span>
                <h1 class="page-hero__title">Pengumuman</h1>
            </div>
            <div class="page-hero__right">
                <span class="page-hero__accent">{{ $pengumumanPage->accent_text ?? 'Informasi penting dan warta terkini untuk umat' }}</span>
            </div>
        </div>
    </section>

    @if ($pinned->isEmpty() && $byYear->isEmpty())
        {{-- Empty state --}}
        <section class="page-section">
            <div class="page-inner">
                <p style="color:rgba(255,255,255,0.35);text-align:center;padding:80px 0;">
                    Belum ada pengumuman yang diterbitkan.
                </p>
            </div>
        </section>
    @else
        {{-- ── "Now" — pinned items ────────────────────────────── --}}
        @if ($pinned->isNotEmpty())
            <section class="page-section">
                <div class="page-inner">
                    <div class="page-2col">
                        <div class="page-2col__label">
                            <span class="page-label">Terpenting</span>
                            <span class="page-year">Now</span>
                        </div>
                        <div class="pengumuman-pinned">
                            @foreach ($pinned as $item)
                                <div class="pengumuman-pin">
                                    @if ($item->foto)
                                        <div class="pengumuman-pin__foto-wrap" onclick="openPhotoModal(this.querySelector('img').src, event)" style="cursor: pointer;">
                                            <img src="{{ media_url($item->foto, 'assets') }}" alt="{{ $item->judul }}">
                                        </div>
                                    @endif
                                    <div class="pengumuman-pin__content">
                                        <div class="pengumuman-pin__header">
                                            <span class="pengumuman-pin__category">{{ $item->kategori }}</span>
                                            <span class="pengumuman-pin__date">
                                                {{ $item->tanggal->translatedFormat('d F Y') }}
                                            </span>
                                        </div>
                                        <h2 class="pengumuman-pin__title">{{ $item->judul }}</h2>
                                        <p class="pengumuman-pin__body">{{ $item->isi }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- ── Per-year groups ─────────────────────────────────── --}}
        @foreach ($byYear as $year => $items)
            <section class="page-section {{ $loop->odd ? 'page-section--alt' : '' }}">
                <div class="page-inner">
                    <div class="page-2col">
                        <div class="page-2col__label">
                            <span class="page-label">Semua Pengumuman</span>
                            <span class="page-year">{{ $year }}</span>
                        </div>
                        <div>
                            <div class="pengumuman-list">
                                @foreach ($items as $item)
                                    <div class="pengumuman-item">
                                        @if ($item->foto)
                                            <div class="pengumuman-item__foto" onclick="openPhotoModal(this.querySelector('img').src, event)" style="cursor: pointer;">
                                                <img src="{{ media_url($item->foto, 'assets') }}" alt="{{ $item->judul }}">
                                            </div>
                                        @endif
                                        <div class="pengumuman-item__left">
                                            <span class="pengumuman-item__category">{{ $item->kategori }}</span>
                                            <h3 class="pengumuman-item__title">{{ $item->judul }}</h3>
                                            <p class="pengumuman-item__desc">{{ $item->isi }}</p>
                                        </div>
                                        <div class="pengumuman-item__right">
                                            <span class="pengumuman-item__date">
                                                {{ $item->tanggal->translatedFormat('d M') }}
                                            </span>
                                            <span class="pengumuman-item__year">{{ $year }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif

    {{-- ── Photo Modal Lightbox ────────────────────────────── --}}
    <div id="photoModal" class="photo-modal" onclick="closePhotoModal(event)">
        <div class="photo-modal__overlay"></div>
        <div class="photo-modal__content">
            <button class="photo-modal__close" onclick="closePhotoModal()" aria-label="Close">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <img id="photoModalImage" src="" alt="" class="photo-modal__image">
        </div>
    </div>

    <script>
        function openPhotoModal(src, event) {
            if (event) event.stopPropagation();
            const modal = document.getElementById('photoModal');
            const img = document.getElementById('photoModalImage');
            img.src = src;
            modal.classList.add('is-active');
            document.body.style.overflow = 'hidden';
        }

        function closePhotoModal(event) {
            if (event && event.target.id !== 'photoModal') return;
            const modal = document.getElementById('photoModal');
            modal.classList.remove('is-active');
            document.body.style.overflow = '';
        }

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closePhotoModal();
        });
    </script>
@endsection
