<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Admin') — Parokimatraman</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('admin_assets/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin_assets/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/dark-mode.css') }}" />
    <script>/* Anti-FOUC */
    (function(){if(localStorage.getItem('parokimatraman_dark_mode')==='dark'){document.documentElement.classList.add('dark');}})();
    </script>
    @yield('styles')
</head>

<body>
    {{-- ── Top header ── --}}
    <header class="admin-header">
        <div class="admin-header__brand">
            <a href="{{ route('admin.dashboard') }}" class="admin-header__brand-name">Parokimatraman</a>
            <span class="admin-header__brand-sub">Admin Panel</span>
        </div>

        {{-- ── Hamburger (mobile) ── --}}
        <button class="admin-header__hamburger" id="adminMenuBtn" aria-label="Buka menu">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round">
                <line x1="3" y1="6" x2="21" y2="6" />
                <line x1="3" y1="12" x2="21" y2="12" />
                <line x1="3" y1="18" x2="21" y2="18" />
            </svg>
        </button>

        <div class="admin-header__right">
            {{-- Dark mode toggle --}}
            <button class="dark-toggle" id="darkToggle" aria-label="Aktifkan mode gelap" title="Mode Gelap">
                <span class="dark-toggle__moon" aria-hidden="true">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                </span>
                <span class="dark-toggle__sun" aria-hidden="true" style="display:none">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                </span>
            </button>
            <span class="admin-header__username">{{ auth('admin')->user()->nama_lengkap }}</span>
            <a href="{{ route('admin.profile.edit') }}" class="admin-header__avatar"
                title="Profil">{{ strtoupper(substr(auth('admin')->user()->nama_depan, 0, 1)) }}</a>
            <form action="{{ route('admin.logout') }}" method="POST" style="margin:0">
                @csrf
                <button type="submit" class="admin-header__logout" title="Keluar">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </header>

    {{-- ── Sub-header navigation ── --}}
    @php $adminUser = auth('admin')->user(); @endphp
    <nav class="admin-nav" id="adminNav">
        <ul class="admin-nav__list">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="admin-nav__link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>

            {{-- Konten dropdown --}}
            @if ($adminUser->hasPermission('beranda','view') || $adminUser->hasPermission('sejarah','view') || $adminUser->hasPermission('visi-misi','view') || $adminUser->hasPermission('peta-paroki','view') || $adminUser->hasPermission('jam-pelayanan','view') || $adminUser->hasPermission('pastor','view') || $adminUser->hasPermission('dewan-paroki','view'))
            <li class="admin-nav__has-dropdown">
                <button
                    class="admin-nav__link admin-nav__toggle {{ request()->routeIs('admin.beranda.*', 'admin.sejarah.*', 'admin.visi-misi.*', 'admin.peta-paroki.*', 'admin.jam-pelayanan.*', 'admin.pastor.*', 'admin.dewan-paroki.*') ? 'active' : '' }}"
                    aria-expanded="false">
                    Konten
                    <svg class="admin-nav__chevron" width="10" height="6" viewBox="0 0 10 6" fill="none">
                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="admin-nav__dropdown">
                    @if ($adminUser->hasPermission('beranda','view'))
                    <li><a href="{{ route('admin.beranda.index') }}"
                            class="{{ request()->routeIs('admin.beranda.index', 'admin.beranda.edit') ? 'active' : '' }}">Hero Beranda</a></li>
                    @endif
                    @if ($adminUser->hasPermission('beranda','edit'))
                    <li><a href="{{ route('admin.beranda.page.edit') }}"
                            class="{{ request()->routeIs('admin.beranda.page.*') ? 'active' : '' }}">Konten Halaman</a></li>
                    @endif
                    @if ($adminUser->hasPermission('sejarah','view'))
                    <li><a href="{{ route('admin.sejarah.index') }}"
                            class="{{ request()->routeIs('admin.sejarah.*') ? 'active' : '' }}">Sejarah</a></li>
                    @endif
                    @if ($adminUser->hasPermission('visi-misi','view'))
                    <li><a href="{{ route('admin.visi-misi.index') }}"
                            class="{{ request()->routeIs('admin.visi-misi.*') ? 'active' : '' }}">Visi &amp; Misi</a>
                    </li>
                    @endif
                    @if ($adminUser->hasPermission('peta-paroki','view'))
                    <li><a href="{{ route('admin.peta-paroki.index') }}"
                            class="{{ request()->routeIs('admin.peta-paroki.*') ? 'active' : '' }}">Peta Paroki</a>
                    </li>
                    @endif
                    @if ($adminUser->hasPermission('jam-pelayanan','view'))
                    <li><a href="{{ route('admin.jam-pelayanan.index') }}"
                            class="{{ request()->routeIs('admin.jam-pelayanan.*') ? 'active' : '' }}">Jam Pelayanan</a>
                    </li>
                    @endif
                    @if ($adminUser->hasPermission('pastor','view'))
                    <li><a href="{{ route('admin.pastor.index') }}"
                            class="{{ request()->routeIs('admin.pastor.*') ? 'active' : '' }}">Pastor</a></li>
                    @endif
                    @if ($adminUser->hasPermission('dewan-paroki','view'))
                    <li><a href="{{ route('admin.dewan-paroki.index') }}"
                            class="{{ request()->routeIs('admin.dewan-paroki.*') ? 'active' : '' }}">Dewan Paroki</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            {{-- Berita dropdown --}}
            @if ($adminUser->hasPermission('berita','view') || $adminUser->hasPermission('kategori-berita','view') || $adminUser->hasPermission('pengumuman','view'))
            <li class="admin-nav__has-dropdown">
                <button
                    class="admin-nav__link admin-nav__toggle {{ request()->routeIs('admin.berita.*', 'admin.kategori-berita.*', 'admin.pengumuman.*') ? 'active' : '' }}"
                    aria-expanded="false">
                    Berita
                    <svg class="admin-nav__chevron" width="10" height="6" viewBox="0 0 10 6" fill="none">
                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="admin-nav__dropdown">
                    @if ($adminUser->hasPermission('berita','view'))
                    <li><a href="{{ route('admin.berita.index') }}"
                            class="{{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">Semua Berita</a></li>
                    @endif
                    @if ($adminUser->hasPermission('kategori-berita','view'))
                    <li><a href="{{ route('admin.kategori-berita.index') }}"
                            class="{{ request()->routeIs('admin.kategori-berita.*') ? 'active' : '' }}">Kategori</a>
                    </li>
                    @endif
                    @if ($adminUser->hasPermission('pengumuman','view'))
                    <li><a href="{{ route('admin.pengumuman.index') }}"
                            class="{{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">Pengumuman</a></li>
                    @endif
                </ul>
            </li>
            @endif

            {{-- Unduhan --}}
            @if ($adminUser->hasPermission('unduhan','view'))
            <li>
                <a href="{{ route('admin.unduhan.index') }}"
                    class="admin-nav__link {{ request()->routeIs('admin.unduhan.*') ? 'active' : '' }}">
                    Unduhan
                </a>
            </li>
            @endif

            {{-- Renungan --}}
            @if ($adminUser->hasPermission('renungan','view'))
            <li>
                <a href="{{ route('admin.renungan.index') }}"
                    class="admin-nav__link {{ request()->routeIs('admin.renungan.*') ? 'active' : '' }}">
                    Renungan
                </a>
            </li>
            @endif

            {{-- Kontak --}}
            @if ($adminUser->hasPermission('kontak','view'))
            <li>
                <a href="{{ route('admin.kontak.index') }}"
                    class="admin-nav__link {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
                    Kontak
                </a>
            </li>
            @endif

            {{-- Pelayanan dropdown --}}
            @if ($adminUser->hasPermission('sakramen','view') || $adminUser->hasPermission('intensi-misa','view'))
            <li class="admin-nav__has-dropdown">
                <button
                    class="admin-nav__link admin-nav__toggle {{ request()->routeIs('admin.sakramen.*', 'admin.intensi-misa.*') ? 'active' : '' }}"
                    aria-expanded="false">
                    Pelayanan
                    <svg class="admin-nav__chevron" width="10" height="6" viewBox="0 0 10 6" fill="none">
                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="admin-nav__dropdown">
                    @if ($adminUser->hasPermission('sakramen','view'))
                    <li><a href="{{ route('admin.sakramen.index') }}"
                            class="{{ request()->routeIs('admin.sakramen.*') ? 'active' : '' }}">Sakramen</a></li>
                    @endif
                    @if ($adminUser->hasPermission('intensi-misa','view'))
                    <li><a href="{{ route('admin.intensi-misa.index') }}"
                            class="{{ request()->routeIs('admin.intensi-misa.*') ? 'active' : '' }}">Intensi Misa</a></li>
                    @endif
                </ul>
            </li>
            @endif

            {{-- Jadwal Misa --}}
            @if ($adminUser->hasPermission('jadwal-misa','view'))
            <li>
                <a href="{{ route('admin.jadwal-misa.index') }}"
                    class="admin-nav__link {{ request()->routeIs('admin.jadwal-misa.*') ? 'active' : '' }}">
                    Jadwal Misa
                </a>
            </li>
            @endif

            {{-- Pengaturan (Admin Users + Role Master) --}}
            @if ($adminUser->hasPermission('admin-users','view') || $adminUser->hasPermission('role-master','view'))
            <li class="admin-nav__has-dropdown">
                <button
                    class="admin-nav__link admin-nav__toggle {{ request()->routeIs('admin.admin-users.*', 'admin.role-master.*') ? 'active' : '' }}"
                    aria-expanded="false">
                    Pengaturan
                    <svg class="admin-nav__chevron" width="10" height="6" viewBox="0 0 10 6" fill="none">
                        <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <ul class="admin-nav__dropdown">
                    @if ($adminUser->hasPermission('admin-users','view'))
                    <li><a href="{{ route('admin.admin-users.index') }}"
                            class="{{ request()->routeIs('admin.admin-users.*') ? 'active' : '' }}">Kelola Admin</a></li>
                    @endif
                    @if ($adminUser->hasPermission('role-master','view'))
                    <li><a href="{{ route('admin.role-master.index') }}"
                            class="{{ request()->routeIs('admin.role-master.*') ? 'active' : '' }}">Role Master</a></li>
                    @endif
                </ul>
            </li>
            @endif

            {{-- Inbox --}}
            @if ($adminUser->hasPermission('inbox','view'))
            <li style="position:relative">
                @php $unread = \App\Models\PesanMasuk::where('is_read', false)->count(); @endphp
                <a href="{{ route('admin.inbox.index') }}"
                    class="admin-nav__link {{ request()->routeIs('admin.inbox.*') ? 'active' : '' }}"
                    style="position:relative">
                    Inbox
                    @if ($unread > 0)
                        <span class="admin-nav__badge">{{ $unread }}</span>
                    @endif
                </a>
            </li>
            @endif

            {{-- Log --}}
            @if ($adminUser->hasPermission('activity-log','view'))
            <li>
                <a href="{{ route('admin.activity-log.index') }}"
                    class="admin-nav__link {{ request()->routeIs('admin.activity-log.*') ? 'active' : '' }}">
                    Log
                </a>
            </li>
            @endif
        </ul>
    </nav>

    {{-- ── Page content ── --}}
    <div class="admin-page">
        <div class="admin-topbar">
            <div>
                <div class="admin-topbar__title">@yield('page_title', 'Dashboard')</div>
                <div class="admin-topbar__breadcrumb">@yield('breadcrumb')</div>
            </div>
            <div>@yield('topbar_actions')</div>
        </div>

        <div class="admin-content">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    @yield('scripts')
    <script>
        /* ── Table: responsive wrap + search + CSV/PDF export ── */
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('table.table').forEach(function(table) {
                if (table.closest('.table-responsive')) return;
                var wrapper = document.createElement('div');
                wrapper.className = 'table-responsive';
                table.parentNode.insertBefore(wrapper, table);
                wrapper.appendChild(table);
            });

            document.querySelectorAll('table.admin-table').forEach(function(table) {
                var cardBody = table.closest('.card__body');
                if (!cardBody || !table.id) return;
                var title = table.dataset.title || 'Data';
                var toolbar = document.createElement('div');
                toolbar.className = 'table-toolbar';
                toolbar.innerHTML =
                    '<input type="text" class="form-control" placeholder="Cari \u2026" id="search-' + table
                    .id +
                    '" autocomplete="off" />' +
                    '<div class="table-toolbar__actions">' +
                    '<button type="button" class="btn btn-secondary" style="font-size:12px;padding:5px 14px;" onclick="exportTableCSV(\'' +
                    table.id + '\',\'' + title + '\')">&#11015; CSV</button>' +
                    '<button type="button" class="btn btn-secondary" style="font-size:12px;padding:5px 14px;" onclick="exportTablePDF(\'' +
                    table.id + '\',\'' + title + '\')">&#11015; PDF</button>' +
                    '</div>';
                cardBody.insertBefore(toolbar, cardBody.firstChild);
                document.getElementById('search-' + table.id).addEventListener('input', function() {
                    var q = this.value.toLowerCase();
                    table.querySelectorAll('tbody tr').forEach(function(row) {
                        row.style.display = (!q || row.textContent.toLowerCase().includes(
                            q)) ? '' : 'none';
                    });
                });
            });
        });

        function exportTableCSV(tableId, filename) {
            var table = document.getElementById(tableId);
            if (!table) return;
            var headers = Array.from(table.querySelectorAll('thead th'))
                .map(function(th) {
                    return '"' + th.textContent.trim().replace(/"/g, '""') + '"';
                })
                .filter(function(h) {
                    return h !== '""';
                });
            var rows = Array.from(table.querySelectorAll('tbody tr'))
                .filter(function(tr) {
                    return tr.style.display !== 'none';
                })
                .map(function(tr) {
                    return Array.from(tr.querySelectorAll('td')).slice(0, headers.length)
                        .map(function(td) {
                            return '"' + td.textContent.trim().replace(/"/g, '""') + '"';
                        })
                        .join(',');
                });
            var csv = '\ufeff' + [headers.join(',')].concat(rows).join('\r\n');
            var blob = new Blob([csv], {
                type: 'text/csv;charset=utf-8'
            });
            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = (filename || 'export') + '.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        function exportTablePDF(tableId, title) {
            var table = document.getElementById(tableId);
            if (!table) return;
            var clone = table.cloneNode(true);
            var html = '<!DOCTYPE html><html><head><meta charset="UTF-8">' +
                '<style>body{font-family:Arial,sans-serif;font-size:11px;padding:16px}' +
                'h2{font-size:14px;margin:0 0 12px}' +
                'table{width:100%;border-collapse:collapse}' +
                'th{padding:6px 10px;font-size:10px;background:#f5f5f5;border:1px solid #ccc;text-align:left}' +
                'td{padding:5px 10px;border:1px solid #ccc;vertical-align:top}</style>' +
                '</head><body><h2>' + title + '</h2>' + clone.outerHTML + '</body></html>';
            var w = window.open('', '_blank', 'width=900,height=700');
            if (!w) {
                alert('Izinkan pop-up untuk mencetak PDF.');
                return;
            }
            w.document.write(html);
            w.document.close();
            setTimeout(function() {
                w.print();
            }, 500);
        }
    </script>
    <script>
        /* ── Top-nav: dropdown + mobile hamburger ── */
        (function() {
            var nav = document.getElementById('adminNav');
            var btn = document.getElementById('adminMenuBtn');

            // Mobile hamburger
            if (btn && nav) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    nav.classList.toggle('admin-nav--open');
                });
            }

            // Dropdown toggles
            document.querySelectorAll('.admin-nav__toggle').forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    var li = this.closest('li');
                    var isOpen = li.classList.contains('admin-nav__dropdown--open');
                    // close all
                    document.querySelectorAll('.admin-nav__has-dropdown').forEach(function(el) {
                        el.classList.remove('admin-nav__dropdown--open');
                        el.querySelector('.admin-nav__toggle').setAttribute('aria-expanded',
                            'false');
                    });
                    if (!isOpen) {
                        li.classList.add('admin-nav__dropdown--open');
                        this.setAttribute('aria-expanded', 'true');
                    }
                });
            });

            // Click outside closes dropdowns
            document.addEventListener('click', function() {
                document.querySelectorAll('.admin-nav__has-dropdown').forEach(function(el) {
                    el.classList.remove('admin-nav__dropdown--open');
                    el.querySelector('.admin-nav__toggle').setAttribute('aria-expanded', 'false');
                });
                if (nav) nav.classList.remove('admin-nav--open');
            });

            // Stop click inside nav from bubbling
            if (nav) nav.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        })();
    </script>
    <script src="{{ asset('js/dark-mode.js') }}"></script>
</body>

</html>
