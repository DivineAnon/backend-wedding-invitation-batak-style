@extends('Admin.Layouts.Admin')

@section('title', 'Inbox')
@section('page_title', 'Inbox')
@section('breadcrumb', 'Layanan / Inbox')

@section('content')
    @if ($unreadCount > 0)
        <div class="alert alert-info" style="margin-bottom:16px;">
            Ada <strong>{{ $unreadCount }}</strong> pesan belum dibaca.
        </div>
    @endif

    {{-- Filter Tanggal --}}
    <form method="GET" action="{{ route('admin.inbox.index') }}" id="form-filter"
        style="display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap;margin-bottom:16px;">
        <div>
            <label style="display:block;font-size:12px;color:var(--muted);margin-bottom:4px;">Dari Tanggal</label>
            <input type="date" name="dari" value="{{ request('dari') }}" class="form-control" style="width:160px;" />
        </div>
        <div>
            <label style="display:block;font-size:12px;color:var(--muted);margin-bottom:4px;">Sampai Tanggal</label>
            <input type="date" name="sampai" value="{{ request('sampai') }}" class="form-control"
                style="width:160px;" />
        </div>
        <button type="submit" class="btn btn-primary" style="height:38px;">Filter</button>
        @if (request('dari') || request('sampai'))
            <a href="{{ route('admin.inbox.index') }}" class="btn btn-secondary"
                style="height:38px;line-height:1.8;">Reset</a>
        @endif
    </form>

    {{-- Bulk Actions Bar --}}
    <div id="bulk-bar"
        style="display:none;align-items:center;gap:12px;background:var(--primary-soft,#eff6ff);border:1px solid var(--primary,#3b82f6);border-radius:8px;padding:10px 16px;margin-bottom:12px;">
        <span id="bulk-count" style="font-size:13px;font-weight:600;color:var(--primary,#3b82f6);"></span>
        <button type="button" onclick="openBulkModal()" class="btn btn-danger"
            style="padding:5px 14px;font-size:13px;">Hapus yang Dipilih</button>
        <button type="button" onclick="clearAll()" class="btn btn-secondary" style="padding:5px 14px;font-size:13px;">Batal
            Pilih</button>
    </div>

    {{-- Bulk Delete Modal --}}
    <div id="modal-bulk"
        style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;">
        <div
            style="background:#fff;border-radius:12px;padding:28px 32px;width:100%;max-width:420px;box-shadow:0 20px 60px rgba(0,0,0,.25);">
            <h3 style="margin:0 0 10px;font-size:1.05rem;font-weight:700;color:var(--text,#111);">Hapus Pesan yang Dipilih?
            </h3>
            <p id="modal-bulk-text" style="margin:0 0 24px;font-size:13px;color:var(--muted);">Tindakan ini tidak dapat
                dibatalkan.</p>
            <div style="display:flex;gap:10px;justify-content:flex-end;">
                <button type="button" onclick="closeBulkModal()" class="btn btn-secondary">Batal</button>
                <button type="button" onclick="submitBulkDelete()" class="btn btn-danger">Ya, Hapus</button>
            </div>
        </div>
    </div>

    {{-- Hidden form for bulk delete --}}
    <form id="form-bulk-delete" method="POST" action="{{ route('admin.inbox.bulk-destroy') }}" style="display:none;">
        @csrf
        @method('DELETE')
        <div id="bulk-ids"></div>
    </form>

    <div class="card">
        <div class="card__header">
            <div class="card__title">Pesan Masuk
                @if (request('dari') || request('sampai'))
                    <span style="font-size:12px;font-weight:400;color:var(--muted);margin-left:8px;">
                        {{ request('dari') ? \Carbon\Carbon::parse(request('dari'))->format('d M Y') : '—' }}
                        s/d
                        {{ request('sampai') ? \Carbon\Carbon::parse(request('sampai'))->format('d M Y') : 'sekarang' }}
                        ({{ $pesans->count() }} pesan)
                    </span>
                @endif
            </div>
        </div>
        <div class="card__body" style="padding:0;">
            <table class="table admin-table" id="tbl-inbox" data-title="Inbox">
                <thead>
                    <tr>
                        <th style="width:36px;padding-left:16px;">
                            <input type="checkbox" id="chk-all" title="Pilih semua"
                                style="width:15px;height:15px;cursor:pointer;" onchange="toggleAll(this)" />
                        </th>
                        <th style="width:16px;"></th>
                        <th>Pengirim</th>
                        <th>Pesan</th>
                        <th>Waktu</th>
                        <th style="width:90px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesans as $pesan)
                        <tr style="{{ !$pesan->is_read ? 'background:var(--primary-soft, #eff6ff);' : '' }}"
                            class="inbox-row">
                            <td style="padding-left:16px;">
                                <input type="checkbox" class="row-chk" value="{{ $pesan->id }}"
                                    style="width:15px;height:15px;cursor:pointer;" onchange="updateBulkBar()" />
                            </td>
                            <td>
                                @if (!$pesan->is_read)
                                    <span title="Belum dibaca"
                                        style="display:inline-block;width:8px;height:8px;border-radius:50%;background:var(--primary,#3b82f6);"></span>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight:{{ !$pesan->is_read ? '600' : '400' }};">{{ $pesan->nama }}</div>
                                <div style="font-size:12px;color:var(--muted);">{{ $pesan->email }}</div>
                                @if ($pesan->telp)
                                    <div style="font-size:12px;color:var(--muted);">{{ $pesan->telp }}</div>
                                @endif
                            </td>
                            <td style="max-width:320px;">
                                <span style="font-size:13px;color:var(--accent);">
                                    {{ Str::limit($pesan->pesan, 100) }}
                                </span>
                            </td>
                            <td style="font-size:12px;color:var(--muted);white-space:nowrap;">
                                {{ $pesan->created_at->format('d M Y H:i') }}
                            </td>
                            <td style="text-align:right;">
                                <a href="{{ route('admin.inbox.show', $pesan) }}" class="btn btn-secondary"
                                    style="padding:4px 10px;font-size:12px;">Buka</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:var(--muted);padding:40px;">
                                Belum ada pesan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function toggleAll(master) {
            document.querySelectorAll('.row-chk').forEach(chk => chk.checked = master.checked);
            updateBulkBar();
        }

        function updateBulkBar() {
            const checked = document.querySelectorAll('.row-chk:checked');
            const bar = document.getElementById('bulk-bar');
            const countEl = document.getElementById('bulk-count');
            const master = document.getElementById('chk-all');
            const all = document.querySelectorAll('.row-chk');

            if (checked.length > 0) {
                bar.style.display = 'flex';
                countEl.textContent = checked.length + ' pesan dipilih';
            } else {
                bar.style.display = 'none';
            }

            // Sync master checkbox state
            master.indeterminate = checked.length > 0 && checked.length < all.length;
            master.checked = all.length > 0 && checked.length === all.length;
        }

        function clearAll() {
            document.querySelectorAll('.row-chk').forEach(chk => chk.checked = false);
            document.getElementById('chk-all').checked = false;
            document.getElementById('chk-all').indeterminate = false;
            document.getElementById('bulk-bar').style.display = 'none';
        }

        function bulkDelete() {
            /* kept for legacy calls — now opens modal */
            openBulkModal();
        }

        function openBulkModal() {
            const checked = document.querySelectorAll('.row-chk:checked');
            if (checked.length === 0) return;
            document.getElementById('modal-bulk-text').textContent =
                'Anda akan menghapus ' + checked.length + ' pesan. Tindakan ini tidak dapat dibatalkan.';
            document.getElementById('modal-bulk').style.display = 'flex';
        }

        function closeBulkModal() {
            document.getElementById('modal-bulk').style.display = 'none';
        }

        function submitBulkDelete() {
            const checked = document.querySelectorAll('.row-chk:checked');
            const container = document.getElementById('bulk-ids');
            container.innerHTML = '';
            checked.forEach(chk => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = chk.value;
                container.appendChild(input);
            });
            document.getElementById('form-bulk-delete').submit();
        }
    </script>
@endsection
