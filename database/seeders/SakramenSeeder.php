<?php

namespace Database\Seeders;

use App\Models\Sakramen;
use Illuminate\Database\Seeder;

class SakramenSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'slug'  => 'sakramen-baptis',
                'judul' => 'Sakramen Baptis',
                'deskripsi' => 'Sakramen Baptis adalah pintu masuk ke dalam kehidupan Kristen dan Gereja Katolik. Melalui sakramen ini, seseorang dibersihkan dari dosa asal dan menjadi anggota penuh Gereja.',
                'sections' => [
                    [
                        'judul' => 'Baptis Bayi',
                        'paragraf' => [
                            'Baptis bayi dilaksanakan setiap bulan bagi anak berusia maksimal 3 tahun. Orang tua wajib mengikuti rekoleksi sebelum pelaksanaan baptis.',
                        ],
                        'list' => [
                            'Mengisi Formulir Baptis Bayi di Sekretariat',
                            'Menyerahkan dokumen yang dibutuhkan ke Sekretariat',
                            'Menunggu informasi jadwal rekoleksi dan pengantar',
                            'Kedua orang tua wajib mengikuti rekoleksi',
                        ],
                    ],
                    [
                        'judul' => 'Baptis Dewasa / Inisiasi',
                        'paragraf' => [
                            'Calon baptis dewasa mengikuti proses katekumenat kurang lebih selama 1 tahun sebelum menerima sakramen inisiasi (Baptis, Komuni Pertama, dan Krisma).',
                        ],
                        'list' => [
                            'Mengisi formulir pendaftaran awal katekumen',
                            'Wawancara awal bersama moderator katekese',
                            'Mengikuti kelas pengantar selama 4 pertemuan (wajib)',
                            'Mengikuti seluruh proses pembelajaran katekumenat',
                        ],
                    ],
                ],
                'kontak_nama'     => 'Sekretariat Paroki',
                'kontak_telepon'  => null,
                'kontak_email'    => null,
                'kontak_catatan'  => 'Hubungi sekretariat paroki untuk informasi jadwal dan formulir.',
                'unduhan' => [],
            ],
            [
                'slug'  => 'komuni-pertama',
                'judul' => 'Komuni Pertama',
                'deskripsi' => 'Komuni Pertama adalah saat seorang umat Katolik untuk pertama kalinya menerima Ekaristi Kudus. Persiapan dilakukan melalui program katekese khusus untuk anak-anak.',
                'sections' => [
                    [
                        'judul' => 'Persiapan Komuni Pertama',
                        'paragraf' => [
                            'Program katekese Komuni Pertama diselenggarakan setiap tahun bagi anak-anak yang telah memenuhi syarat usia dan sudah dibaptis Katolik.',
                        ],
                        'list' => [
                            'Sudah dibaptis Katolik',
                            'Mendaftar di Sekretariat Paroki',
                            'Mengikuti seluruh sesi katekese yang telah dijadwalkan',
                            'Mengikuti misa latihan dan retret persiapan',
                        ],
                    ],
                ],
                'kontak_nama'    => 'Sekretariat Paroki',
                'kontak_telepon' => null,
                'kontak_email'   => null,
                'kontak_catatan' => 'Pendaftaran dibuka setiap awal tahun. Hubungi sekretariat untuk informasi lebih lanjut.',
                'unduhan' => [],
            ],
            [
                'slug'  => 'sakramen-krisma',
                'judul' => 'Sakramen Krisma',
                'deskripsi' => 'Sakramen Krisma (Penguatan) menyempurnakan rahmat baptis dan memperkuat umat untuk menjadi saksi Kristus yang dewasa dalam iman.',
                'sections' => [
                    [
                        'judul' => 'Persiapan Krisma',
                        'paragraf' => [
                            'Program persiapan Krisma meliputi serangkaian katekese, retret, dan pertemuan pembinaan iman untuk remaja dan dewasa.',
                        ],
                        'list' => [
                            'Sudah menerima Sakramen Baptis dan Komuni Pertama',
                            'Mendaftar di Sekretariat Paroki',
                            'Mengikuti seluruh sesi persiapan Krisma',
                            'Melengkapi dokumen yang diperlukan',
                        ],
                    ],
                ],
                'kontak_nama'    => 'Sekretariat Paroki',
                'kontak_telepon' => null,
                'kontak_email'   => null,
                'kontak_catatan' => 'Jadwal persiapan Krisma diumumkan melalui warta paroki.',
                'unduhan' => [],
            ],
            [
                'slug'  => 'sakramen-rekonsiliasi',
                'judul' => 'Sakramen Rekonsiliasi',
                'deskripsi' => 'Sakramen Rekonsiliasi (Pengakuan Dosa) adalah sakramen penyembuhan yang memberikan pengampunan dosa melalui pelayanan imam.',
                'sections' => [
                    [
                        'judul' => 'Jadwal Pengakuan Dosa',
                        'paragraf' => [
                            'Pengakuan dosa tersedia sebelum Misa harian dan pada jadwal khusus yang tersedia di sekretariat paroki.',
                        ],
                        'list' => [
                            'Datang ke gereja sesuai jadwal pengakuan dosa',
                            'Persiapkan diri dengan pemeriksaan batin',
                            'Imamat siap melayani sesuai jadwal tersedia',
                        ],
                    ],
                ],
                'kontak_nama'    => 'Sekretariat Paroki',
                'kontak_telepon' => null,
                'kontak_email'   => null,
                'kontak_catatan' => 'Untuk pengakuan dosa di luar jadwal, silakan hubungi sekretariat.',
                'unduhan' => [],
            ],
            [
                'slug'  => 'sakramen-pengurapan',
                'judul' => 'Sakramen Pengurapan Orang Sakit',
                'deskripsi' => 'Sakramen Pengurapan Orang Sakit memberikan kekuatan, damai, dan keberanian bagi umat yang sedang sakit keras atau menghadapi usia lanjut.',
                'sections' => [
                    [
                        'judul' => 'Prosedur Pengurapan',
                        'paragraf' => [
                            'Sakramen ini dapat diterima oleh umat Katolik yang sedang sakit keras, akan menjalani operasi besar, atau sudah lanjut usia. Hubungi sekretariat untuk mengatur kunjungan pastor.',
                        ],
                        'list' => [
                            'Hubungi sekretariat paroki atau telepon langsung',
                            'Sampaikan kondisi umat yang membutuhkan',
                            'Pastor akan mengatur waktu kunjungan',
                        ],
                    ],
                ],
                'kontak_nama'    => 'Sekretariat Paroki',
                'kontak_telepon' => null,
                'kontak_email'   => null,
                'kontak_catatan' => 'Untuk keadaan darurat, hubungi pastor on-call melalui sekretariat.',
                'unduhan' => [],
            ],
            [
                'slug'  => 'sakramen-perkawinan',
                'judul' => 'Sakramen Perkawinan',
                'deskripsi' => 'Sakramen Perkawinan adalah perjanjian cinta antara seorang pria dan wanita yang diberkati Gereja, bersifat satu dan tak terceraikan.',
                'sections' => [
                    [
                        'judul' => 'Persyaratan',
                        'paragraf' => [
                            'Calon pengantin wajib mempersiapkan diri secara rohani dan administratif minimal 6 bulan sebelum hari pernikahan.',
                        ],
                        'list' => [
                            'Surat Baptis yang telah diperbarui',
                            'KK Katolik kedua calon',
                            'Surat pengantar dari lingkungan',
                            'Fotokopi KTP dan Akta Kelahiran',
                            'Mengikuti Kursus Persiapan Perkawinan (MRT)',
                        ],
                    ],
                    [
                        'judul' => 'Langkah Pendaftaran',
                        'paragraf' => [
                            'Hubungi sekretariat paroki untuk mengecek ketersediaan jadwal sebelum mempersiapkan dokumen.',
                        ],
                        'list' => [
                            'Cek ketersediaan jadwal ke sekretariat',
                            'Lengkapi dan serahkan dokumen administrasi',
                            'Ikuti penyelidikan kanonik bersama imam',
                            'Konfirmasi jadwal dan pemberkatan',
                        ],
                    ],
                ],
                'kontak_nama'    => 'Sekretariat Paroki',
                'kontak_telepon' => null,
                'kontak_email'   => null,
                'kontak_catatan' => 'Pendaftaran perkawinan dilayani selama jam kantor. Pemberkatan hari Sabtu diprioritaskan untuk warga paroki.',
                'unduhan' => [],
            ],
            [
                'slug'  => 'sakramen-imamat',
                'judul' => 'Sakramen Imamat',
                'deskripsi' => 'Sakramen Imamat menahbiskan seseorang sebagai diakon, imam, atau uskup untuk melayani umat Allah. Paroki mendukung dan mendoakan setiap panggilan imamat.',
                'sections' => [
                    [
                        'judul' => 'Panggilan Imamat',
                        'paragraf' => [
                            'Jika Anda merasakan benih panggilan imamat, jangan ragu untuk berbicara dengan pastor paroki. Paroki siap mendampingi dan mengarahkan perjalanan panggilan Anda.',
                        ],
                        'list' => [
                            'Menghubungi pastor paroki dan menyampaikan panggilan',
                            'Mencari informasi mengenai seminari',
                            'Mengikuti proses seleksi dan formasi seminari',
                        ],
                    ],
                    [
                        'judul' => 'Tingkatan Tahbisan',
                        'paragraf' => [
                            'Terdapat tiga tingkatan tahbisan dalam Gereja Katolik: Diakonat, Presbiterat (Imam), dan Episkopat (Uskup). Setiap tahbisan diberikan melalui penumpangan tangan dan doa tahbisan.',
                        ],
                        'list' => [],
                    ],
                ],
                'kontak_nama'    => 'Pastor Paroki',
                'kontak_telepon' => null,
                'kontak_email'   => null,
                'kontak_catatan' => 'Untuk informasi panggilan imamat, silakan berbicara langsung dengan pastor paroki.',
                'unduhan' => [],
            ],
        ];

        foreach ($data as $item) {
            Sakramen::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
