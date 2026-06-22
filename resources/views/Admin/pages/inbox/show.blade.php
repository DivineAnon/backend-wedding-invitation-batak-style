@extends('Admin.Layouts.Admin')

@section('title', 'Detail Pesan')
@section('page_title', 'Detail Pesan')
@section('breadcrumb', 'Layanan / Inbox / Detail')

@section('topbar_actions')
    <a href="{{ route('admin.inbox.index') }}" class="btn btn-secondary">← Kembali</a>
@endsection

@section('content')
    <div style="display:grid;grid-template-columns:1fr 280px;gap:20px;align-items:start;">

        {{-- Pesan --}}
        <div class="card">
            <div class="card__header">
                <div class="card__title">Isi Pesan</div>
            </div>
            <div class="card__body">
                <p style="font-size:15px;line-height:1.7;white-space:pre-wrap;">{{ $pesan->pesan }}</p>
            </div>
        </div>

        {{-- Info & Aksi --}}
        <div>
            <div class="card" style="margin-bottom:20px;">
                <div class="card__header">
                    <div class="card__title">Pengirim</div>
                </div>
                <div class="card__body">
                    <table style="width:100%;border-collapse:collapse;">
                        <tr>
                            <td style="padding:5px 0;color:var(--muted);font-size:12px;width:80px;">Nama</td>
                            <td style="padding:5px 0;font-size:13px;font-weight:500;">{{ $pesan->nama }}</td>
                        </tr>
                        <tr>
                            <td style="padding:5px 0;color:var(--muted);font-size:12px;">Email</td>
                            <td style="padding:5px 0;font-size:13px;">
                                <a href="mailto:{{ $pesan->email }}" style="color:var(--primary);">{{ $pesan->email }}</a>
                            </td>
                        </tr>
                        @if ($pesan->telp)
                            <tr>
                                <td style="padding:5px 0;color:var(--muted);font-size:12px;">Telepon</td>
                                <td style="padding:5px 0;font-size:13px;">{{ $pesan->telp }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td style="padding:5px 0;color:var(--muted);font-size:12px;">Dikirim</td>
                            <td style="padding:5px 0;font-size:13px;color:var(--muted);">
                                {{ $pesan->created_at->format('d M Y, H:i') }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:5px 0;color:var(--muted);font-size:12px;">Status</td>
                            <td style="padding:5px 0;">
                                @if ($pesan->is_read)
                                    <span class="badge badge-success">Sudah dibaca</span>
                                @else
                                    <span class="badge badge-secondary">Belum dibaca</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Aksi --}}
            <div class="card">
                <div class="card__header">
                    <div class="card__title">Aksi</div>
                </div>
                <div class="card__body" style="display:flex;flex-direction:column;gap:8px;">
                    @if ($pesan->is_read)
                        <form action="{{ route('admin.inbox.unread', $pesan) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-secondary" style="width:100%;">
                                Tandai Belum Dibaca
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.inbox.read', $pesan) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-secondary" style="width:100%;">
                                Tandai Sudah Dibaca
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('admin.inbox.destroy', $pesan) }}" method="POST" id="form-del">
                        @csrf @method('DELETE')
                        <button type="button" onclick="document.getElementById('modal-del').style.display='flex'"
                            class="btn btn-danger" style="width:100%;">Hapus Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete confirm modal --}}
    <div id="modal-del"
        style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;">
        <div
            style="background:#fff;border-radius:12px;padding:28px 32px;width:100%;max-width:400px;box-shadow:0 20px 60px rgba(0,0,0,.25);">
            <h3 style="margin:0 0 10px;font-size:1.05rem;font-weight:700;color:#111;">Hapus pesan ini?</h3>
            <p style="margin:0 0 24px;font-size:13px;color:var(--muted);">Pesan dari <strong>{{ $pesan->nama }}</strong>
                akan dihapus permanen dan tidak bisa dipulihkan.</p>
            <div style="display:flex;gap:10px;justify-content:flex-end;">
                <button type="button" onclick="document.getElementById('modal-del').style.display='none'"
                    class="btn btn-secondary">Batal</button>
                <button type="button" onclick="document.getElementById('form-del').submit()" class="btn btn-danger">Ya,
                    Hapus</button>
            </div>
        </div>
    </div>
@endsection
