@extends('Admin.Layouts.Admin')

@section('title', 'Jadwal Misa')
@section('page_title', 'Jadwal Misa')
@section('breadcrumb', 'Pengaturan / Jadwal Misa')

@section('topbar_actions')
    <a href="{{ route('admin.jadwal-misa.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
@endsection

@section('content')
    {{-- Delete confirm modal --}}
    <div id="modal-del"
        style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;">
        <div
            style="background:#fff;border-radius:12px;padding:28px 32px;width:100%;max-width:400px;box-shadow:0 20px 60px rgba(0,0,0,.25);">
            <h3 style="margin:0 0 10px;font-size:1.05rem;font-weight:700;color:#111;">Hapus jadwal ini?</h3>
            <p id="modal-del-text" style="margin:0 0 24px;font-size:13px;color:var(--muted);">Tindakan ini tidak dapat
                dibatalkan.</p>
            <div style="display:flex;gap:10px;justify-content:flex-end;">
                <button type="button" onclick="document.getElementById('modal-del').style.display='none'"
                    class="btn btn-secondary">Batal</button>
                <button type="button" id="modal-del-confirm" class="btn btn-danger">Ya, Hapus</button>
            </div>
        </div>
    </div>

    @php
        $hariOrder = ['Senin — Jumat', 'Sabtu', 'Minggu', 'Jumat Pertama'];
        $sorted = collect($jadwals)->sortBy(
            fn($v, $k) => array_search($k, $hariOrder) !== false ? array_search($k, $hariOrder) : 99,
        );
    @endphp

    @forelse ($sorted as $hariGroup => $items)
        <div class="card" style="margin-bottom:20px;">
            <div class="card__header">
                <div class="card__title">{{ $hariGroup }}</div>
            </div>
            <div class="card__body" style="padding:0;">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th>Jam</th>
                            <th>Tipe</th>
                            <th style="width:60px;">Urutan</th>
                            <th style="width:100px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $j)
                            <tr>
                                <td style="font-weight:600;letter-spacing:.03em;">{{ $j->jam }}</td>
                                <td>{{ $j->tipe }}</td>
                                <td style="font-size:13px;color:var(--muted);">{{ $j->urutan }}</td>
                                <td style="text-align:right;">
                                    <div style="display:flex;gap:6px;justify-content:flex-end;">
                                        <a href="{{ route('admin.jadwal-misa.edit', $j) }}" class="btn btn-secondary"
                                            style="padding:4px 10px;font-size:12px;">Edit</a>
                                        <button type="button" class="btn btn-danger"
                                            style="padding:4px 10px;font-size:12px;"
                                            onclick="openDelModal({{ $j->id }}, '{{ addslashes($j->tipe) }} {{ $j->jam }}')">Hapus</button>
                                        <form id="del-form-{{ $j->id }}"
                                            action="{{ route('admin.jadwal-misa.destroy', $j) }}" method="POST"
                                            style="display:none;">
                                            @csrf @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="card">
            <div class="card__body" style="text-align:center;color:var(--muted);padding:48px;">
                Belum ada jadwal misa. <a href="{{ route('admin.jadwal-misa.create') }}">Tambah sekarang →</a>
            </div>
        </div>
    @endforelse
@endsection

@section('scripts')
    <script>
        let delFormId = null;

        function openDelModal(id, label) {
            delFormId = id;
            document.getElementById('modal-del-text').textContent = 'Jadwal "' + label + '" akan dihapus permanen.';
            document.getElementById('modal-del').style.display = 'flex';
        }
        document.getElementById('modal-del-confirm').addEventListener('click', function() {
            if (delFormId) document.getElementById('del-form-' + delFormId).submit();
        });
    </script>
@endsection
