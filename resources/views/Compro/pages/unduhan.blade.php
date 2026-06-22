@extends('Compro.Layouts.Compro')

@section('title', 'Unduhan — Paroki Santo Yoseph Matraman')

@section('content')
    <!-- Hero -->
    <section class="page-hero">
        @if ($unduhanPage->hero_image)
            <img src="{{ media_url($unduhanPage->hero_image, 'assets/unduhan') }}" alt="" class="page-hero__bg" aria-hidden="true" />
        @else
            <div class="page-hero__bg"></div>
        @endif
        <div class="page-hero__content">
            <span class="page-hero__eyebrow">Layanan</span>
            <h1 class="page-hero__title">Unduhan</h1>
            <p class="page-hero__accent">Formulir &amp; Dokumen</p>
        </div>
    </section>

    <section class="page-section">
        <div class="page-inner">
            <p class="unduhan-intro">Unduh formulir, pedoman, dan materi paroki yang Anda butuhkan.</p>

            <div class="unduhan-tabs" role="tablist" aria-label="Kategori Unduhan">
                <button class="unduhan-tabs__btn unduhan-tabs__btn--active" role="tab" aria-selected="true"
                    data-tab="dokumen">Dokumen Biasa</button>
                <button class="unduhan-tabs__btn" role="tab" aria-selected="false" data-tab="ebook">Ebook</button>
            </div>

            <!-- Tab: Dokumen Biasa -->
            <div class="unduhan-panel" id="tab-dokumen" role="tabpanel">
                @if ($dokumen->isEmpty())
                    <div class="unduhan-majalah-empty">
                        <p class="unduhan-majalah-empty__text">Belum ada dokumen yang tersedia.</p>
                    </div>
                @else
                    <ul class="unduhan-list">
                        @foreach ($dokumen as $item)
                            @php $ext = strtolower(pathinfo($item->nama_file, PATHINFO_EXTENSION)); @endphp
                            <li class="unduhan-item">
                                <span class="unduhan-item__icon" aria-hidden="true">
                                    @if (in_array($ext, ['png', 'jpg', 'jpeg', 'webp', 'gif']))
                                        <svg width="20" height="24" viewBox="0 0 20 24" fill="none">
                                            <rect x="0.5" y="0.5" width="19" height="23" rx="2.5"
                                                stroke="currentColor" />
                                            <circle cx="7" cy="9" r="1.5" fill="currentColor" />
                                            <path d="M3 17l4-5 3 4 2-2 4 3" stroke="currentColor" stroke-width="1.3"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    @elseif (in_array($ext, ['xls', 'xlsx', 'csv']))
                                        <svg width="20" height="24" viewBox="0 0 20 24" fill="none">
                                            <rect x="0.5" y="0.5" width="19" height="23" rx="2.5"
                                                stroke="currentColor" />
                                            <path d="M4 8h12M4 12h12M4 16h12M8 8v12M12 8v12" stroke="currentColor"
                                                stroke-width="1.2" stroke-linecap="round" />
                                        </svg>
                                    @else
                                        <svg width="20" height="24" viewBox="0 0 20 24" fill="none">
                                            <rect x="0.5" y="0.5" width="19" height="23" rx="2.5"
                                                stroke="currentColor" />
                                            <path d="M5 8h10M5 12h10M5 16h6" stroke="currentColor" stroke-width="1.4"
                                                stroke-linecap="round" />
                                        </svg>
                                    @endif
                                </span>
                                <span class="unduhan-item__name">
                                    {{ $item->judul }}
                                    @if ($item->deskripsi)
                                        <small
                                            style="display:block;font-size:0.95rem;margin-top:2px;">{{ $item->deskripsi }}</small>
                                    @endif
                                </span>
                                <span class="unduhan-item__fmt">{{ $item->format_label }}</span>
                                <a href="{{ route('unduhan.download', $item) }}"
                                    class="unduhan-item__dl">&#8595;&nbsp;Unduh</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Tab: Ebook -->
            <div class="unduhan-panel unduhan-panel--hidden" id="tab-ebook" role="tabpanel">
                @if ($ebook->isEmpty())
                    <div class="unduhan-majalah-empty">
                        <p class="unduhan-majalah-empty__text">Belum ada ebook yang tersedia.<br />Segera hadir.</p>
                    </div>
                @else
                    <ul class="unduhan-list">
                        @foreach ($ebook as $item)
                            <li class="unduhan-item">
                                <span class="unduhan-item__icon" aria-hidden="true">
                                    <svg width="20" height="24" viewBox="0 0 20 24" fill="none">
                                        <rect x="0.5" y="0.5" width="19" height="23" rx="2.5"
                                            stroke="currentColor" />
                                        <path d="M5 8h10M5 12h10M5 16h6" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" />
                                    </svg>
                                </span>
                                <span class="unduhan-item__name">
                                    {{ $item->judul }}
                                    @if ($item->deskripsi)
                                        <small
                                            style="display:block;font-size:0.95rem;margin-top:2px;">{{ $item->deskripsi }}</small>
                                    @endif
                                </span>
                                <span class="unduhan-item__fmt">LINK</span>
                                @if ($item->link)
                                    <a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer"
                                        class="unduhan-item__dl">&#8599;&nbsp;Buka</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </section>

    <script>
        (function() {
            var btns = document.querySelectorAll('.unduhan-tabs__btn');
            btns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    btns.forEach(function(b) {
                        b.classList.remove('unduhan-tabs__btn--active');
                        b.setAttribute('aria-selected', 'false');
                    });
                    document.querySelectorAll('.unduhan-panel').forEach(function(p) {
                        p.classList.add('unduhan-panel--hidden');
                    });
                    btn.classList.add('unduhan-tabs__btn--active');
                    btn.setAttribute('aria-selected', 'true');
                    var panel = document.getElementById('tab-' + btn.dataset.tab);
                    if (panel) panel.classList.remove('unduhan-panel--hidden');
                });
            });
        })();
    </script>
@endsection
