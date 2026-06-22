<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        // Copy dummy images
        $srcImage = public_path('compro_assets/image/hero.jpg');
        $beritaDir = public_path('compro_assets/image/berita');

        if (!is_dir($beritaDir)) {
            mkdir($beritaDir, 0755, true);
        }

        for ($i = 1; $i <= 6; $i++) {
            $dest = $beritaDir . '/berita-dummy-' . $i . '.jpg';
            if (!file_exists($dest)) {
                copy($srcImage, $dest);
            }
        }

        // Insert categories
        $now = Carbon::now();
        $kategoris = [
            ['nama' => 'Opini',                  'slug' => 'opini'],
            ['nama' => 'Figur',                  'slug' => 'figur'],
            ['nama' => 'Sharing',                'slug' => 'sharing'],
            ['nama' => 'Kabar Seksi/Kategorial', 'slug' => 'kabar-seksi-kategorial'],
            ['nama' => 'Kabar Umum',             'slug' => 'kabar-umum'],
        ];

        foreach ($kategoris as $kat) {
            DB::table('kategori_berita')->insertOrIgnore([
                'nama'       => $kat['nama'],
                'slug'       => $kat['slug'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Fetch inserted category IDs
        $ids = DB::table('kategori_berita')
            ->whereIn('slug', array_column($kategoris, 'slug'))
            ->pluck('id', 'slug');

        // 6 berita articles
        $beritaData = [
            [
                'kategori_id' => $ids['opini'],
                'judul'       => 'Gereja dan Tantangan Zaman Modern',
                'slug'        => 'gereja-dan-tantangan-zaman-modern',
                'ringkasan'   => 'Bagaimana gereja dapat tetap relevan dan menjawab tantangan kehidupan umat di era modern ini.',
                'isi'         => '<p>Di tengah arus globalisasi dan perubahan sosial yang begitu cepat, gereja dipanggil untuk hadir sebagai terang dan garam dunia. Kita perlu menemukan cara baru untuk menjangkau hati umat tanpa kehilangan esensi iman yang mendalam.</p><p>Tantangan terbesar bukan pada teknologi semata, namun pada bagaimana kita membangun komunitas yang hangat, inklusif, dan penuh kasih di tengah masyarakat yang semakin individualistis.</p>',
                'gambar'      => 'berita-dummy-1.jpg',
                'status'      => 'published',
                'published_at' => $now->copy()->subDays(5),
            ],
            [
                'kategori_id' => $ids['figur'],
                'judul'       => 'Pastor Paroki: Melayani dengan Hati yang Tulus',
                'slug'        => 'pastor-paroki-melayani-dengan-hati-yang-tulus',
                'ringkasan'   => 'Mengenal lebih dekat sosok pastor paroki kita yang telah mendedikasikan hidupnya untuk pelayanan.',
                'isi'         => '<p>Sudah lebih dari sepuluh tahun beliau berkarya di paroki ini. Dengan senyum yang selalu hangat dan kesabaran yang tak pernah habis, Pastor telah menjadi pilar kuat bagi kehidupan iman umat.</p><p>"Pelayanan bukan tentang posisi, melainkan tentang kehadiran," demikian beliau sering berkata kepada para pengurus stasi yang datang meminta bimbingan.</p>',
                'gambar'      => 'berita-dummy-2.jpg',
                'status'      => 'published',
                'published_at' => $now->copy()->subDays(4),
            ],
            [
                'kategori_id' => $ids['sharing'],
                'judul'       => 'Kisah Iman di Tengah Kesulitan',
                'slug'        => 'kisah-iman-di-tengah-kesulitan',
                'ringkasan'   => 'Seorang umat berbagi pengalaman bagaimana iman membantunya melewati masa-masa sulit dalam hidupnya.',
                'isi'         => '<p>Tahun lalu adalah tahun terberat dalam hidup saya. Kehilangan pekerjaan, lalu disusul sakit yang panjang, membuat saya nyaris putus asa. Namun setiap Minggu, ketika duduk dalam Misa, saya merasakan kekuatan yang sulit saya jelaskan dengan kata-kata.</p><p>Komunitas paroki hadir bukan hanya dengan doa, tetapi juga dengan tindakan nyata — mereka yang mengantarkan makanan, menemani di rumah sakit, dan mendengarkan keluh kesah tanpa menghakimi. Itu yang mengubah hidup saya.</p>',
                'gambar'      => 'berita-dummy-3.jpg',
                'status'      => 'published',
                'published_at' => $now->copy()->subDays(3),
            ],
            [
                'kategori_id' => $ids['kabar-seksi-kategorial'],
                'judul'       => 'OMK Paroki Gelar Retret Tahunan dengan Penuh Semangat',
                'slug'        => 'omk-paroki-gelar-retret-tahunan-dengan-penuh-semangat',
                'ringkasan'   => 'Orang Muda Katolik paroki mengadakan retret tahunan yang diikuti oleh lebih dari 80 peserta.',
                'isi'         => '<p>Retret tahunan OMK berlangsung selama tiga hari di Pusat Retret Gunung Sari. Dengan tema <em>"Berani Bersaksi"</em>, para peserta diajak untuk mendalami panggilan mereka sebagai orang muda Katolik yang aktif dan berani mewartakan Injil.</p><p>Berbagai sesi pendalaman iman, permainan kelompok, dan adorasi malam menjadi momen yang tak terlupakan bagi seluruh peserta. Panitia berharap semangat ini terus terbawa dalam kehidupan sehari-hari.</p>',
                'gambar'      => 'berita-dummy-4.jpg',
                'status'      => 'published',
                'published_at' => $now->copy()->subDays(2),
            ],
            [
                'kategori_id' => $ids['kabar-umum'],
                'judul'       => 'Perayaan Natal Paroki Berjalan Khidmat dan Meriah',
                'slug'        => 'perayaan-natal-paroki-berjalan-khidmat-dan-meriah',
                'ringkasan'   => 'Perayaan Natal tahun ini dihadiri oleh ribuan umat dan berlangsung dengan penuh sukacita.',
                'isi'         => '<p>Misa Malam Natal dan Misa Natal pagi berlangsung dengan khidmat dan penuh sukacita. Gereja dihiasi dengan dekorasi yang indah, sementara koor paroki menyanyikan lagu-lagu Natal dengan merdu.</p><p>Pastor dalam homilinya mengajak seluruh umat untuk memaknai kelahiran Kristus bukan sekadar perayaan tahunan, tetapi sebagai undangan untuk memperbarui komitmen iman dalam kehidupan sehari-hari.</p>',
                'gambar'      => 'berita-dummy-5.jpg',
                'status'      => 'published',
                'published_at' => $now->copy()->subDays(1),
            ],
            [
                'kategori_id' => $ids['kabar-umum'],
                'judul'       => 'Jadwal Misa Bulan Ini dan Pengumuman Pemberkatan',
                'slug'        => 'jadwal-misa-bulan-ini-dan-pengumuman-pemberkatan',
                'ringkasan'   => 'Informasi jadwal lengkap Misa harian dan mingguan serta agenda pemberkatan umat bulan ini.',
                'isi'         => '<p>Berikut adalah jadwal Misa untuk bulan ini yang perlu diketahui oleh seluruh umat paroki:</p><ul><li><strong>Misa Harian</strong>: Senin–Sabtu pukul 06.00 WIB di gereja induk</li><li><strong>Misa Minggu</strong>: Pukul 07.00, 09.00, dan 17.00 WIB</li><li><strong>Misa Stasi</strong>: Sesuai jadwal masing-masing stasi</li></ul><p>Pemberkatan rumah dan kendaraan akan diadakan pada akhir bulan ini. Umat yang berminat dapat mendaftar di sekretariat paroki.</p>',
                'gambar'      => 'berita-dummy-6.jpg',
                'status'      => 'published',
                'published_at' => $now,
            ],
        ];

        foreach ($beritaData as $berita) {
            DB::table('berita')->insertOrIgnore([
                'kategori_berita_id' => $berita['kategori_id'],
                'judul'              => $berita['judul'],
                'slug'               => $berita['slug'],
                'ringkasan'          => $berita['ringkasan'],
                'isi'                => $berita['isi'],
                'gambar'             => $berita['gambar'],
                'status'             => $berita['status'],
                'published_at'       => $berita['published_at'],
                'created_at'         => $now,
                'updated_at'         => $now,
            ]);
        }

        $this->command->info('BeritaSeeder: 5 kategori dan 6 berita berhasil dibuat.');
    }
}
