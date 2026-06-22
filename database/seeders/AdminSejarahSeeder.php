<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Sejarah;
use App\Models\SejarahMilestone;

class AdminSejarahSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin default (superadmin) ────────────────────────
        $superadmin = Admin::firstOrCreate(
            ['username' => 'superadmin'],
            [
                'nama_depan'    => 'Super',
                'nama_belakang' => 'Admin',
                'username'      => 'superadmin',
                'password'      => Hash::make('admin123!'),
                'is_superadmin' => true,
            ]
        );
        // Ensure existing record also gets superadmin flag + updated password
        if (!$superadmin->wasRecentlyCreated) {
            $superadmin->forceFill([
                'is_superadmin' => true,
                'password'      => Hash::make('admin123!'),
            ])->save();
        }

        // ── Sejarah ───────────────────────────────────────────
        $sejarah = Sejarah::firstOrCreate(
            ['id' => 1],
            [
                'hero_image'  => 'hero.jpg',
                'accent_text' => "1906 \u2014 Kini\nParoki Santo Yoseph Matraman",
                'label'       => 'Perjalanan Paroki',
                'year'        => '1906',
                'source'      => 'Buku Memperingati 100 Tahun Gereja Santo Yoseph, Paroki Matraman',
                'body'        => [
                    'Lahirnya Paroki Matraman bermula dari pembelian sebidang tanah di tepi Jalan Raya Matramanweg pada 13 Desember 1906 untuk persiapan pembangunan gereja di daerah Meester Cornelis — kawasan yang kemudian disebut Jatinegara. Beberapa hari kemudian, tepatnya 28 Desember 1906, sebuah stasi dibentuk di daerah ini dan pelayanan umat dilaksanakan oleh imam dari Paroki Katedral, yakni Romo J. Hoevenaars SJ.',
                    'Sekitar tiga tahun kemudian, seperti tercatat dalam Registrum Baptismale I, Ecclesia Catholicae quae est Meester Cornelis in Insula Java, permandian pertama dilaksanakan pada 22 Juni 1909. Dalam catatan ini, orang yang dipermandikan adalah Christina Wilhelmina Cornelia yang lahir pada 14 Mei 1909 di Meester Cornelis — anak dari pasangan Abraham van Oorde dan Jurgina Wilhelmina Zeydel. Wali baptisnya adalah W.J. Pullens dan imam yang mempermandikannya adalah Romo J. Hoevenaars SJ.',
                    'Tanggal permandian tersebut ditetapkan sebagai tanggal kelahiran Paroki Matraman oleh Romo Yan Djawa SVD, pastor kepala paroki periode 1989–1999. Selanjutnya, pada 21 April 1910, pelayanan umat di Meester Cornelis diserahterimakan kepada Romo Th. Van Swieten SJ. Pada 1919, pelayanan yang semula diatur oleh Paroki Katedral kemudian diserahkan kepada Paroki Kramat seiring dengan pertumbuhan jumlah umat di daerah Jatinegara.',
                    'Sejak 1908 hingga 1924, sebelum memiliki gedung gereja, umat merayakan Misa di Kapel Susteran Ursulin — yang sejak 1955 sampai sekarang menjadi Susteran OSF di Jl. Matraman Raya 129. Daerah Meester Cornelis merupakan stasi pertama dari Paroki Katedral yang kemudian berkembang menjadi Paroki Matraman. Hingga 1950-an, Paroki Matraman masih dilayani oleh imam asing, dengan beberapa tahun tanpa catatan nama imam.',
                    'Umat Paroki Matraman pernah digembalakan oleh para imam tarekat Yesuit dan Fransiskan. Tidaklah mengherankan jika salah satu patung orang kudus di altar gereja adalah Santo Antonius Padua — yang tetap diberi tempat istimewa bersama patung Santo Yoseph, penyangga dan pelindung Gereja.',
                    'Tonggak sejarah berikutnya adalah penyerahan kepada tarekat SVD (Societas Verbi Divini — Serikat Sabda Allah). Berdasarkan perjanjian kesepakatan antara Mgr. A. Djajaseputra SJ, Vikaris Apostolik Jakarta, dan Romo E. Kuehne SVD pada 30 Desember 1953, pelayanan Paroki Matraman diserahkan kepada para imam SVD hingga saat ini. Pastor kepala Paroki Matraman yang pertama adalah Romo J. Hoevenaars SJ (1906–1910), sedangkan pastor kepala pribumi yang pertama adalah Romo Yan Lali SVD (1974–1979).',
                ],
            ]
        );

        // ── Milestones ────────────────────────────────────────
        if ($sejarah->milestones()->count() === 0) {
            $milestones = [
                ['tahun' => '13 Des 1906', 'judul' => 'Pembelian Tanah & Pembentukan Stasi',       'deskripsi' => 'Sebidang tanah di Jl. Matramanweg dibeli. Stasi Meester Cornelis dibentuk, dilayani Romo J. Hoevenaars SJ dari Paroki Katedral.'],
                ['tahun' => '22 Jun 1909', 'judul' => 'Permandian Pertama',                        'deskripsi' => 'Permandian pertama tercatat atas nama Christina Wilhelmina Cornelia — ditetapkan sebagai hari kelahiran Paroki Matraman.'],
                ['tahun' => '1910',        'judul' => 'Penyerahan ke Romo van Swieten SJ',         'deskripsi' => 'Pelayanan di Meester Cornelis diserahterimakan kepada Romo Th. Van Swieten SJ pada 21 April 1910.'],
                ['tahun' => '1908 – 1924', 'judul' => 'Misa di Kapel Susteran Ursulin',            'deskripsi' => 'Sebelum memiliki gedung gereja sendiri, umat merayakan Misa di Kapel Susteran Ursulin, Jl. Matraman Raya 129.'],
                ['tahun' => '1924',        'judul' => 'Gereja Santo Yoseph Berdiri',               'deskripsi' => 'Gedung gereja resmi berdiri di Jl. Matraman Raya 127, menjadi pusat pelayanan umat hingga saat ini.'],
                ['tahun' => '1930 – 1940', 'judul' => 'Diserahkan ke Ordo Fransiskan',             'deskripsi' => 'Pelayanan paroki beralih ke tangan para imam Ordo Fransiskan (OFM).'],
                ['tahun' => '30 Des 1953', 'judul' => 'Diserahkan ke Serikat Sabda Allah (SVD)',   'deskripsi' => 'Berdasarkan perjanjian antara Mgr. A. Djajaseputra SJ dan Romo E. Kuehne SVD, paroki diserahkan kepada imam-imam SVD yang melayani hingga kini.'],
                ['tahun' => '1974',        'judul' => 'Pastor Kepala Pribumi Pertama',             'deskripsi' => 'Romo Yan Lali SVD menjadi pastor kepala pribumi pertama Paroki Matraman (1974–1979).'],
            ];

            foreach ($milestones as $i => $ms) {
                SejarahMilestone::create([
                    'sejarah_id' => $sejarah->id,
                    'tahun'      => $ms['tahun'],
                    'judul'      => $ms['judul'],
                    'deskripsi'  => $ms['deskripsi'],
                    'urutan'     => $i,
                ]);
            }
        }
    }
}
