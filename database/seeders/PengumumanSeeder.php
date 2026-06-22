<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        if (Pengumuman::count() > 0) {
            return;
        }

        $data = [
            // ── Pinned / Terpenting ────────────────────────────────────────
            [
                'judul'     => 'Jadwal Misa Pekan Suci & Paskah 2026',
                'kategori'  => 'Jadwal Misa',
                'isi'       => 'Pekan Suci dimulai Minggu Palma, 29 Maret 2026. Misa Malam Paskah dirayakan Sabtu, 4 April 2026 pukul 20.00 WIB. Umat diharapkan hadir tepat waktu karena kapasitas gereja terbatas. Pendaftaran tempat duduk dibuka mulai 15 Maret 2026 di sekretariat paroki.',
                'tanggal'   => '2026-03-10',
                'is_pinned' => true,
                'is_active' => true,
            ],
            [
                'judul'     => 'Pemberkatan Pernikahan — Syarat & Prosedur Terbaru',
                'kategori'  => 'Sakramen',
                'isi'       => 'Calon pasangan yang merencanakan pernikahan tahun 2026 wajib mendaftarkan diri minimal 6 bulan sebelum hari-H. Dokumen yang diperlukan: akta baptis terbaru (maks. 6 bulan), surat keterangan belum menikah, KTP, dan surat izin orang tua (bagi yang belum berusia 21 tahun). Hubungi sekretariat untuk jadwal konsultasi.',
                'tanggal'   => '2026-03-05',
                'is_pinned' => true,
                'is_active' => true,
            ],
            [
                'judul'     => 'Penerimaan Komuni Pertama & Krisma 2026',
                'kategori'  => 'Sakramen',
                'isi'       => 'Pendaftaran katekumen Komuni Pertama dibuka hingga 31 Maret 2026 untuk anak-anak usia 8–12 tahun. Persiapan Krisma bagi remaja (usia 14 tahun ke atas) dimulai April 2026 setiap Sabtu pukul 09.00 WIB. Formulir pendaftaran tersedia di meja sekretariat.',
                'tanggal'   => '2026-03-01',
                'is_pinned' => true,
                'is_active' => true,
            ],

            // ── 2026 — tidak pinned ────────────────────────────────────────
            [
                'judul'     => 'Kolekte APP (Aksi Puasa Pembangunan) Pekan III',
                'kategori'  => 'Keuangan',
                'isi'       => 'Kolekte APP Pekan III akan dilaksanakan pada Minggu, 22 Maret 2026. Tema tahun ini adalah "Bertumbuh dalam Kasih dan Kepedulian". Amplop APP telah dibagikan kepada setiap keluarga melalui lingkungan masing-masing.',
                'tanggal'   => '2026-03-08',
                'is_pinned' => false,
                'is_active' => true,
            ],
            [
                'judul'     => 'Retret Orang Muda Katolik (OMK) — April 2026',
                'kategori'  => 'Kegiatan',
                'isi'       => 'OMK Paroki Matraman menyelenggarakan retret tahunan pada 18–20 April 2026 di Wisma Samadi, Klender. Biaya Rp 350.000/orang (sudah termasuk akomodasi dan konsumsi). Pendaftaran paling lambat 5 April 2026. Kuota terbatas 40 peserta.',
                'tanggal'   => '2026-03-06',
                'is_pinned' => false,
                'is_active' => true,
            ],
            [
                'judul'     => 'Jadwal Pengakuan Dosa Masa Prapaskah',
                'kategori'  => 'Sakramen',
                'isi'       => 'Selama masa Prapaskah, pengakuan dosa tambahan tersedia setiap Jumat pukul 17.00–18.30 WIB. Pengakuan komunal direncanakan pada Rabu, 1 April 2026 pukul 18.00 WIB. Hadir lebih awal untuk mengambil nomor antrian.',
                'tanggal'   => '2026-02-28',
                'is_pinned' => false,
                'is_active' => true,
            ],
            [
                'judul'     => 'Penggalangan Dana Renovasi Aula Paroki',
                'kategori'  => 'Keuangan',
                'isi'       => 'Dewan Paroki mengajak seluruh umat untuk berpartisipasi dalam penggalangan dana renovasi aula. Target dana Rp 450 juta. Donasi dapat diserahkan ke sekretariat atau melalui transfer ke rekening paroki. Laporan penggunaan dana akan disampaikan secara berkala melalui bulletin.',
                'tanggal'   => '2026-02-15',
                'is_pinned' => false,
                'is_active' => true,
            ],
            [
                'judul'     => 'Pertemuan Dewan Pastoral Paroki — Maret 2026',
                'kategori'  => 'Administrasi',
                'isi'       => 'Pertemuan Dewan Pastoral Paroki (DPP) bulan Maret akan diselenggarakan pada Selasa, 17 Maret 2026 pukul 19.00 WIB di Aula St. Yoseph. Agenda utama: evaluasi program Prapaskah dan persiapan Pekan Suci. Semua ketua seksi harap hadir.',
                'tanggal'   => '2026-02-10',
                'is_pinned' => false,
                'is_active' => true,
            ],
            [
                'judul'     => 'Pelayanan Pengurusan Surat Baptis & Surat Keterangan Gereja',
                'kategori'  => 'Pelayanan',
                'isi'       => 'Mulai 1 Maret 2026, pengurusan surat baptis dan surat keterangan gereja dapat dilakukan secara online melalui formulir di website paroki. Proses penerbitan membutuhkan 3 hari kerja. Pengambilan dokumen tetap dilakukan di sekretariat paroki pada jam kerja (Senin–Jumat, 08.00–16.00 WIB).',
                'tanggal'   => '2026-02-01',
                'is_pinned' => false,
                'is_active' => true,
            ],
            [
                'judul'     => 'Bakti Sosial Paroki — Kunjungan ke Panti Asuhan',
                'kategori'  => 'Sosial',
                'isi'       => 'Seksi Sosial mengajak umat untuk berpartisipasi dalam bakti sosial kunjungan ke Panti Asuhan St. Vincentius pada Sabtu, 14 Maret 2026 pukul 09.00 WIB. Umat yang ingin berdonasi dapat menyerahkan sumbangan berupa pakaian layak pakai, alat tulis, atau uang tunai ke sekretariat paling lambat Kamis, 12 Maret 2026.',
                'tanggal'   => '2026-01-20',
                'is_pinned' => false,
                'is_active' => true,
            ],

            // ── 2025 ───────────────────────────────────────────────────────
            [
                'judul'     => 'Natal 2025 — Jadwal Misa & Pendaftaran Tempat Duduk',
                'kategori'  => 'Jadwal Misa',
                'isi'       => 'Misa Malam Natal 24 Desember pukul 17.00 dan 22.00 WIB. Misa Hari Raya Natal 25 Desember pukul 07.00, 09.30, dan 17.00 WIB. Pendaftaran tempat duduk melalui sekretariat pada 1–15 Desember 2025.',
                'tanggal'   => '2025-12-10',
                'is_pinned' => false,
                'is_active' => true,
            ],
            [
                'judul'     => 'Perayaan HUT Paroki ke-116 — Agustus 2025',
                'kategori'  => 'Kegiatan',
                'isi'       => 'Dalam rangka memperingati HUT Paroki ke-116, berbagai kegiatan akan diselenggarakan sepanjang bulan Agustus 2025: lomba olahraga antar lingkungan, festival seni budaya, malam keakraban, dan Misa peringatan pada 22 Juni 2025. Informasi selengkapnya akan diumumkan melalui bulletin.',
                'tanggal'   => '2025-08-05',
                'is_pinned' => false,
                'is_active' => true,
            ],
            [
                'judul'     => 'Pembaruan Data Umat — Sensus Paroki 2025',
                'kategori'  => 'Administrasi',
                'isi'       => 'Dewan Paroki melaksanakan sensus umat sepanjang Juli–September 2025. Setiap keluarga dimohon untuk mengisi formulir data terbaru melalui ketua lingkungan masing-masing. Data yang akurat membantu paroki dalam perencanaan pastoral dan pelayanan.',
                'tanggal'   => '2025-07-01',
                'is_pinned' => false,
                'is_active' => true,
            ],
            [
                'judul'     => 'Pembentukan Pengurus Lingkungan Periode 2025–2028',
                'kategori'  => 'Administrasi',
                'isi'       => 'Pemilihan pengurus lingkungan baru untuk periode 2025–2028 dijadwalkan pada April–Mei 2025. Setiap lingkungan diharapkan menyelenggarakan musyawarah pemilihan dan melaporkan hasilnya ke sekretariat paling lambat 31 Mei 2025.',
                'tanggal'   => '2025-04-10',
                'is_pinned' => false,
                'is_active' => true,
            ],
            [
                'judul'     => 'Program Beasiswa Paroki untuk Pelajar Berprestasi',
                'kategori'  => 'Sosial',
                'isi'       => 'Paroki Matraman membuka pendaftaran program beasiswa untuk siswa SD, SMP, dan SMA dari keluarga umat yang kurang mampu. Seleksi berdasarkan nilai akademis dan kondisi ekonomi keluarga. Formulir pendaftaran tersedia di sekretariat paroki. Batas pendaftaran 28 Februari 2025.',
                'tanggal'   => '2025-02-05',
                'is_pinned' => false,
                'is_active' => true,
            ],
            [
                'judul'     => 'Jadwal Misa Harian & Mingguan — Januari 2025',
                'kategori'  => 'Jadwal Misa',
                'isi'       => 'Misa harian Senin–Jumat pukul 06.00 WIB. Misa Sabtu pukul 06.00 dan 17.00 WIB. Misa Minggu pukul 06.00, 08.30, 11.00, dan 17.00 WIB. Perubahan jadwal pada hari libur nasional akan diumumkan melalui bulletin.',
                'tanggal'   => '2025-01-05',
                'is_pinned' => false,
                'is_active' => true,
            ],
        ];

        foreach ($data as $row) {
            Pengumuman::create($row);
        }
    }
}
