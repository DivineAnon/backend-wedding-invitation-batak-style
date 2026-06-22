<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VisiMisiPetaParokiSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Visi & Misi — only insert if table is empty
        if (DB::table('visi_misi')->count() === 0) {
            DB::table('visi_misi')->insert([
                'visi' => 'Terwujudnya Persekutuan dan Gerakan umat Allah yang berkualitas keimanannya dalam Yesus Kristus, untuk membangun persaudaraan sejati, peduli terhadap sesama, pelayanan kasih dengan sukacita Injili — didasari semangat missioner kepada Gereja, Bangsa dan Negara.',
                'misi_intro' => 'Melaksanakan program-program pastoral-evangelisasi yang dilandasi Spiritualitas Gembala Baik dan Murah Hati, disertai dengan Spiritualitas dan Semangat Santo Yoseph, ditopang oleh tata-penggembalaan yang dilakukan secara sinergis, dialogis, partisipatif, dan transformatif oleh seluruh umat.',
                'misi_pillars' => json_encode([
                    [
                        'nama' => 'Iman',
                        'deskripsi' => 'Meningkatkan partisipasi aktif umat dalam menyelenggarakan sakramen-sakramen, ibadat-ibadat, dan pendalaman iman bersama dalam semangat Injil.',
                    ],
                    [
                        'nama' => 'Persaudaraan',
                        'deskripsi' => 'Meningkatkan semangat kekeluargaan dengan sesama, baik yang seiman maupun dengan warga sekitar, yang tampak nyata dalam kehadiran di setiap peristiwa penting kehidupan.',
                    ],
                    [
                        'nama' => 'Peduli',
                        'deskripsi' => 'Mampu menunjukkan perilaku berbela rasa, mempunyai hati untuk orang lain, memberikan diri dengan tulus demi menolong orang lain yang membutuhkan sehingga menjadi manusia yang ekaristis.',
                    ],
                    [
                        'nama' => 'Pelayanan',
                        'deskripsi' => 'Mampu menunjukkan sikap ketaatan pelayan pastoral-evangelisasi yang didasari semangat missioner pada setiap tugas perutusan yang dipercayakan kepadanya.',
                    ],
                ]),
                'spiritualitas' => 'Pelayanan Paroki Matraman dilandasi oleh spiritualitas inkarnasi Yesus Kristus, Gembala Baik dan Murah Hati dengan spiritualitas dan semangat Santo Yoseph. Nilai-nilai ini menjadi napas sehari-hari dalam setiap tindakan pastoral dan kehidupan komunitas.',
                'nilai_nilai' => json_encode([
                    'Setia kepada Gereja, Bangsa dan Negara',
                    'Taat dalam Iman dan Perutusan-Nya',
                    'Yakin, Jujur dan Rendah Hati',
                    'Organisasi yang dinamis dan kreatif',
                    'Semangat dalam Pelayanan',
                    'Etis dalam bersikap',
                    'Peka, Peduli dan Penuh Kasih',
                    'Harmonis dan Lembut Hati',
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Peta Paroki — only insert if table is empty
        if (DB::table('peta_paroki')->count() === 0) {
            DB::table('peta_paroki')->insert([
                'alamat'            => 'Jl. Matraman Raya 127',
                'kota'              => 'Jakarta 13320',
                'telepon'           => '(021) 858-3782',
                'faks'              => '(021) 856-8417',
                'email'             => 'info.sekre.sanyos@gmail.com',
                'maps_embed_url'    => null,
                'gambar'            => 'peta_paroki.jpg',
                'jam_senin_jumat'   => '08.00 – 15.00',
                'jam_sabtu'         => '08.00 – 13.00',
                'jam_minggu'        => '08.00 – 12.00',
                'catatan_pelayanan' => 'Sekretariat Paroki melayani keperluan administrasi sakramen, surat menyurat, dan pelayanan pastoral selama jam kerja. Silakan menghubungi terlebih dahulu untuk keperluan khusus di luar jam tersebut.',
                'created_at'        => $now,
                'updated_at'        => $now,
            ]);
        }

        $this->command->info('VisiMisiPetaParokiSeeder: data berhasil dibuat.');
    }
}
