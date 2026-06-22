@extends('Admin.Layouts.Admin')

@section('title', 'Log Aktivitas')
@section('page_title', 'Log Aktivitas')
@section('breadcrumb', 'Sistem / Log Aktivitas')

@section('content')
    {{-- Filter bar --}}
    <form method="GET" action="{{ route('admin.activity-log.index') }}"
        style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:20px;align-items:flex-end">
        <div>
            <label class="form-label" style="font-size:11px">Modul</label>
            <select name="module" class="form-control" style="font-size:13px;min-width:140px">
                <option value="">Semua Modul</option>
                @foreach ($modules as $mod)
                    <option value="{{ $mod }}" {{ request('module') === $mod ? 'selected' : '' }}>
                        {{ $mod }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label" style="font-size:11px">Aksi</label>
            <select name="action" class="form-control" style="font-size:13px;min-width:130px">
                <option value="">Semua Aksi</option>
                @foreach ($actions as $act)
                    <option value="{{ $act }}" {{ request('action') === $act ? 'selected' : '' }}>
                        {{ ucfirst($act) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label" style="font-size:11px">Cari</label>
            <input type="text" name="search" class="form-control" placeholder="Nama admin / item..."
                style="font-size:13px;min-width:200px" value="{{ request('search') }}">
        </div>
        <div style="display:flex;gap:8px">
            <button type="submit" class="btn btn-primary" style="font-size:13px">Filter</button>
            <a href="{{ route('admin.activity-log.index') }}" class="btn btn-secondary" style="font-size:13px">Reset</a>
        </div>
    </form>

    {{-- Stats row --}}
    <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px">
        @php $total = $logs->total(); @endphp
        <div class="card" style="flex:1;min-width:140px">
            <div class="card__body" style="padding:14px 18px">
                <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.06em">Total Log</div>
                <div style="font-size:24px;font-weight:700">{{ number_format($total) }}</div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card">
        <div class="card__header">
            <span class="card__title">Riwayat Aktivitas</span>
            <span style="font-size:12px;color:var(--muted)">{{ $logs->total() }} catatan</span>
        </div>
        <div class="card__body" style="padding:0">
            @if ($logs->isEmpty())
                <div style="padding:40px;text-align:center;color:var(--muted)">Belum ada log aktivitas.</div>
            @else
                <table class="table" id="tbl-activity-log" data-title="Log Aktivitas">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Aksi</th>
                            <th>Modul</th>
                            <th>Item / Target</th>
                            <th>Admin</th>
                            <th>IP Address</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td style="color:var(--muted);white-space:nowrap;font-size:12px">
                                    {{ $log->created_at->format('d M Y') }}<br>
                                    <span style="font-size:11px">{{ $log->created_at->format('H:i:s') }}</span>
                                </td>
                                <td>
                                    <span
                                        style="
                                        display:inline-block;padding:2px 8px;border-radius:4px;font-size:11px;
                                        font-weight:600;letter-spacing:.04em;text-transform:uppercase;
                                        background:{{ $log->action_color }}22;color:{{ $log->action_color }}
                                    ">{{ $log->action_label }}</span>
                                </td>
                                <td style="color:var(--muted);font-size:13px">{{ $log->module }}</td>
                                <td>
                                    @if ($log->target_label)
                                        {{ $log->target_label }}
                                        @if ($log->target_id)
                                            <span style="font-size:11px;color:var(--muted)">#{{ $log->target_id }}</span>
                                        @endif
                                    @else
                                        <span style="color:var(--muted)">—</span>
                                    @endif
                                </td>
                                <td style="font-size:13px">{{ $log->admin_name }}</td>
                                <td style="font-size:12px;color:var(--muted)">{{ $log->ip_address ?? '—' }}</td>
                                <td>
                                    @if ($log->changes)
                                        <button type="button"
                                            onclick="showChanges({{ $log->id }}, {{ json_encode($log->changes) }})"
                                            style="background:none;border:none;cursor:pointer;color:var(--accent);font-size:12px"
                                            title="Lihat perubahan">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <circle cx="11" cy="11" r="8" />
                                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                            </svg>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- Pagination --}}
    @if ($logs->hasPages())
        <div style="margin-top:16px">{{ $logs->links() }}</div>
    @endif

    {{-- Changes modal --}}
    <div id="changes-modal"
        style="display:none;position:fixed;inset:0;z-index:1000;background:rgba(0,0,0,.55);
               align-items:center;justify-content:center">
        <div
            style="background:var(--surface);border-radius:10px;padding:24px;max-width:540px;width:90%;
                    max-height:80vh;overflow-y:auto;position:relative">
            <button onclick="document.getElementById('changes-modal').style.display='none'"
                style="position:absolute;top:12px;right:14px;background:none;border:none;
                       cursor:pointer;color:var(--muted);font-size:18px">✕</button>
            <div style="font-weight:600;font-size:14px;margin-bottom:16px">Detail Perubahan</div>
            <table style="width:100%;border-collapse:collapse;font-size:12px" id="changes-table">
                <thead>
                    <tr>
                        <th
                            style="text-align:left;padding:6px 8px;border-bottom:1px solid var(--border);
                                   color:var(--muted);text-transform:uppercase;font-size:10px;letter-spacing:.06em">
                            Field</th>
                        <th
                            style="text-align:left;padding:6px 8px;border-bottom:1px solid var(--border);
                                   color:var(--muted);text-transform:uppercase;font-size:10px;letter-spacing:.06em">
                            Sebelum</th>
                        <th
                            style="text-align:left;padding:6px 8px;border-bottom:1px solid var(--border);
                                   color:var(--muted);text-transform:uppercase;font-size:10px;letter-spacing:.06em">
                            Sesudah</th>
                    </tr>
                </thead>
                <tbody id="changes-body"></tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showChanges(id, changes) {
            const body = document.getElementById('changes-body');
            body.innerHTML = '';
            if (!changes || Object.keys(changes).length === 0) {
                body.innerHTML =
                    '<tr><td colspan="3" style="padding:12px;color:var(--muted);text-align:center">Tidak ada perubahan tercatat.</td></tr>';
            } else {
                Object.entries(changes).forEach(([field, diff]) => {
                    const tr = document.createElement('tr');
                    const before = diff.before !== null && diff.before !== undefined ? String(diff.before) : '—';
                    const after = diff.after !== null && diff.after !== undefined ? String(diff.after) : '—';
                    tr.innerHTML = `
                        <td style="padding:6px 8px;border-bottom:1px solid var(--border);color:var(--muted)">${field}</td>
                        <td style="padding:6px 8px;border-bottom:1px solid var(--border);color:#ef4444">${before}</td>
                        <td style="padding:6px 8px;border-bottom:1px solid var(--border);color:#22c55e">${after}</td>`;
                    body.appendChild(tr);
                });
            }
            document.getElementById('changes-modal').style.display = 'flex';
        }

        document.getElementById('changes-modal').addEventListener('click', function(e) {
            if (e.target === this) this.style.display = 'none';
        });
    </script>
@endsection


@section('content')
    {{-- Filter bar --}}
    <form method="GET" action="{{ route('admin.activity-log.index') }}"
        style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:20px;align-items:flex-end">
        <div>
            <label class="form-label" style="font-size:11px">Modul</label>
            <select name="module" class="form-control" style="font-size:13px;min-width:140px">
                <option value="">Semua Modul</option>
                @foreach ($modules as $mod)
                    <option value="{{ $mod }}" {{ request('module') === $mod ? 'selected' : '' }}>
                        {{ $mod }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label" style="font-size:11px">Aksi</label>
            <select name="action" class="form-control" style="font-size:13px;min-width:130px">
                <option value="">Semua Aksi</option>
                @foreach ($actions as $act)
                    <option value="{{ $act }}" {{ request('action') === $act ? 'selected' : '' }}>
                        {{ ucfirst($act) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label" style="font-size:11px">Cari</label>
            <input type="text" name="search" class="form-control" placeholder="Nama admin / item..."
                style="font-size:13px;min-width:200px" value="{{ request('search') }}">
        </div>
        <div style="display:flex;gap:8px">
            <button type="submit" class="btn btn-primary" style="font-size:13px">Filter</button>
            <a href="{{ route('admin.activity-log.index') }}" class="btn btn-secondary" style="font-size:13px">Reset</a>
        </div>
    </form>

    {{-- Stats row --}}
    <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px">
        @php
            $total = $logs->total();
            $todayFmt = now()->format('Y-m-d');
        @endphp
        <div class="card" style="flex:1;min-width:140px">
            <div class="card__body" style="padding:14px 18px">
                <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.06em">Total Log
                </div>
                <div style="font-size:24px;font-weight:700;color:var(--text)">{{ number_format($total) }}</div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="admin-table" style="font-size:13px">
            <thead>
                <tr>
                    <th style="width:150px">Waktu</th>
                    <th style="width:110px">Aksi</th>
                    <th style="width:120px">Modul</th>
                    <th>Item / Target</th>
                    <th style="width:140px">Admin</th>
                    <th style="width:110px">IP Address</th>
                    <th style="width:40px"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td style="color:var(--muted);white-space:nowrap">
                            {{ $log->created_at->format('d M Y') }}<br>
                            <span style="font-size:11px">{{ $log->created_at->format('H:i:s') }}</span>
                        </td>
                        <td>
                            <span
                                style="
                                display:inline-block;padding:2px 8px;border-radius:4px;font-size:11px;
                                font-weight:600;letter-spacing:.04em;text-transform:uppercase;
                                background:{{ $log->action_color }}22;color:{{ $log->action_color }}
                            ">{{ $log->action_label }}</span>
                        </td>
                        <td style="color:var(--muted)">{{ $log->module }}</td>
                        <td>
                            @if ($log->target_label)
                                {{ $log->target_label }}
                                @if ($log->target_id)
                                    <span style="font-size:11px;color:var(--muted)">#{{ $log->target_id }}</span>
                                @endif
                            @else
                                <span style="color:var(--muted)">—</span>
                            @endif
                        </td>
                        <td>{{ $log->admin_name }}</td>
                        <td style="font-size:11px;color:var(--muted)">{{ $log->ip_address ?? '—' }}</td>
                        <td>
                            @if ($log->changes)
                                <button type="button"
                                    onclick="showChanges({{ $log->id }}, {{ json_encode($log->changes) }})"
                                    style="background:none;border:none;cursor:pointer;color:var(--accent);font-size:12px"
                                    title="Lihat perubahan">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="11" cy="11" r="8" />
                                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                    </svg>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;color:var(--muted);padding:48px">
                            Belum ada log aktivitas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($logs->hasPages())
        <div style="margin-top:16px">{{ $logs->links() }}</div>
    @endif

    {{-- Changes modal --}}
    <div id="changes-modal"
        style="display:none;position:fixed;inset:0;z-index:1000;background:rgba(0,0,0,.55);
               align-items:center;justify-content:center">
        <div
            style="background:var(--sidebar-bg);border-radius:10px;padding:24px;max-width:540px;width:90%;
                    max-height:80vh;overflow-y:auto;position:relative">
            <button onclick="document.getElementById('changes-modal').style.display='none'"
                style="position:absolute;top:12px;right:14px;background:none;border:none;
                       cursor:pointer;color:var(--muted);font-size:18px">✕</button>
            <div style="font-weight:600;font-size:14px;margin-bottom:16px;color:var(--text)">
                Detail Perubahan
            </div>
            <table style="width:100%;border-collapse:collapse;font-size:12px" id="changes-table">
                <thead>
                    <tr>
                        <th
                            style="text-align:left;padding:6px 8px;border-bottom:1px solid var(--border);
                                   color:var(--muted);text-transform:uppercase;font-size:10px;letter-spacing:.06em">
                            Field</th>
                        <th
                            style="text-align:left;padding:6px 8px;border-bottom:1px solid var(--border);
                                   color:var(--muted);text-transform:uppercase;font-size:10px;letter-spacing:.06em">
                            Sebelum</th>
                        <th
                            style="text-align:left;padding:6px 8px;border-bottom:1px solid var(--border);
                                   color:var(--muted);text-transform:uppercase;font-size:10px;letter-spacing:.06em">
                            Sesudah</th>
                    </tr>
                </thead>
                <tbody id="changes-body"></tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showChanges(id, changes) {
            const body = document.getElementById('changes-body');
            body.innerHTML = '';
            if (!changes || Object.keys(changes).length === 0) {
                body.innerHTML =
                    '<tr><td colspan="3" style="padding:12px;color:var(--muted);text-align:center">Tidak ada perubahan tercatat.</td></tr>';
            } else {
                Object.entries(changes).forEach(([field, diff]) => {
                    const tr = document.createElement('tr');
                    const before = diff.before !== null && diff.before !== undefined ? String(diff.before) : '—';
                    const after = diff.after !== null && diff.after !== undefined ? String(diff.after) : '—';
                    tr.innerHTML = `
                        <td style="padding:6px 8px;border-bottom:1px solid var(--border);color:var(--muted)">${field}</td>
                        <td style="padding:6px 8px;border-bottom:1px solid var(--border);color:#ef4444">${before}</td>
                        <td style="padding:6px 8px;border-bottom:1px solid var(--border);color:#22c55e">${after}</td>`;
                    body.appendChild(tr);
                });
            }
            document.getElementById('changes-modal').style.display = 'flex';
        }

        document.getElementById('changes-modal').addEventListener('click', function(e) {
            if (e.target === this) this.style.display = 'none';
        });
    </script>
@endsection
