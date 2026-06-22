<?php

namespace Database\Seeders;

use App\Models\Renungan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RenunganSeeder extends Seeder
{
    public function run(): void
    {
        Renungan::truncate();

        $data = [
            [
                'tema'         => 'Kasih',
                'judul'        => 'Kasih yang Tak Berkesudahan',
                'kutipan'      => '"Kasihilah satu sama lain, sama seperti Aku telah mengasihi kamu." — Yoh 13:34',
                'isi'          => '<p>Dalam kehidupan sehari-hari, kita sering kali dihadapkan pada situasi yang menguji kesabaran dan kasih kita kepada sesama. Tuhan Yesus mengajarkan bahwa kasih bukan sekadar perasaan, melainkan sebuah tindakan nyata yang harus kita wujudkan.</p><p>Kasih yang sejati tidak memandang siapa orangnya, tidak memperhitungkan jasa, dan tidak mengharap balasan. Seperti kasih Bapa kepada kita yang diwujudkan melalui pengorbanan Putra-Nya, kita pun dipanggil untuk mengasihi tanpa syarat.</p><p>Marilah hari ini kita memperbarui tekad untuk mengasihi orang-orang di sekitar kita — keluarga, tetangga, rekan kerja, bahkan mereka yang mungkin pernah menyakiti kita. Inilah bukti nyata bahwa kita adalah murid-murid Kristus.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(1),
            ],
            [
                'tema'         => 'Doa',
                'judul'        => 'Kekuatan dalam Doa',
                'kutipan'      => '"Mintalah, maka akan diberikan kepadamu; carilah, maka kamu akan mendapat." — Mat 7:7',
                'isi'          => '<p>Doa adalah nafas rohani kita. Tanpa doa, jiwa kita akan layu dan kering seperti tanah yang tidak pernah mendapat hujan. Santo Paulus menasihati kita untuk "berdoa tanpa henti" — bukan berarti kita harus berlutut setiap saat, tetapi menjaga hubungan yang terus-menerus dengan Allah.</p><p>Tuhan tidak membutuhkan kata-kata yang indah dan panjang. Ia merindukan hati yang tulus dan jiwa yang lapar akan hadirat-Nya. Sebuah doa sederhana yang keluar dari lubuk hati jauh lebih berharga daripada ribuan kata yang hanya di bibir saja.</p><p>Jadikanlah doa sebagai bagian tak terpisahkan dari hari-harimu. Awali pagi dengan bersyukur, tutup malam dengan menyerahkan seluruh hidupmu kepada-Nya.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'tema'         => 'Pengampunan',
                'judul'        => 'Berani Mengampuni',
                'kutipan'      => '"Ampunilah kami akan kesalahan kami, seperti kami juga mengampuni orang yang bersalah kepada kami." — Mat 6:12',
                'isi'          => '<p>Mengampuni adalah salah satu tindakan paling heroik yang dapat dilakukan manusia. Di dunia yang penuh dengan luka dan kekecewaan, mengampuni terasa seperti sebuah kemustahilan. Namun itulah yang dituntut Injil dari kita.</p><p>Pengampunan bukan berarti kita melupakan atau membiarkan kesalahan terjadi. Pengampunan adalah keputusan untuk tidak membiarkan kebencian menguasai hati kita. Ini adalah pembebasan — bukan hanya bagi yang diampuni, tetapi terutama bagi yang mengampuni.</p><p>Tuhan Yesus sendiri memberi teladan tertinggi dari salib: "Ya Bapa, ampunilah mereka, sebab mereka tidak tahu apa yang mereka perbuat." Biarlah semangat pengampunan ini mengalir dalam hidup kita setiap hari.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'tema'         => 'Iman',
                'judul'        => 'Iman Sebesar Biji Sesawi',
                'kutipan'      => '"Sesungguhnya sekiranya kamu mempunyai iman sebesar biji sesawi saja, kamu dapat berkata kepada gunung ini: Pindah dari sini ke sana, maka gunung ini akan pindah." — Mat 17:20',
                'isi'          => '<p>Iman tidak diukur dari besarnya, melainkan dari kualitasnya. Tuhan Yesus mengajarkan bahwa iman sekecil biji sesawi pun sudah cukup untuk menggerakkan gunung. Artinya, yang Tuhan inginkan bukan iman yang hebat dalam ukuran manusia, melainkan iman yang murni dan sungguh-sungguh diserahkan kepada-Nya.</p><p>Kita sering kali meragukan diri sendiri dan merasa iman kita terlalu kecil untuk menghadapi pergumulan hidup. Namun ingatlah: Tuhan adalah penulis dan penyempurna iman kita. Ketika kita lemah, Ia kuat. Ketika kita ragu, Ia setia.</p><p>Izinkanlah iman itu bertumbuh melalui doa, Sabda, dan sakramen. Setiap langkah kecil dalam kepercayaan kepada Tuhan adalah kemenangan rohani yang nyata.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(10),
            ],
            [
                'tema'         => 'Harapan',
                'judul'        => 'Harapan di Tengah Kegelapan',
                'kutipan'      => '"Sebab Aku ini mengetahui rancangan-rancangan apa yang ada pada-Ku mengenai kamu, demikianlah firman TUHAN, yaitu rancangan damai sejahtera dan bukan rancangan kecelakaan." — Yer 29:11',
                'isi'          => '<p>Ada kalanya hidup terasa gelap dan jalan ke depan tidak tampak jelas. Kesedihan, kehilangan, kegagalan — semua itu adalah bagian dari perjalanan manusia yang tidak bisa dihindari. Namun di tengah semua itu, iman Kristen menawarkan sesuatu yang dunia tidak dapat berikan: harapan.</p><p>Harapan Kristiani bukan sekadar optimisme kosong. Ini adalah keyakinan mendalam bahwa Tuhan yang menciptakan kita juga yang memimpin setiap langkah kita — bahkan ketika kita tidak melihatnya. Rancangan-Nya selalu baik, meskipun jalan yang harus kita tempuh kadang berat.</p><p>Peganglah firman ini hari ini: Tuhan memiliki rencana yang indah bagi hidupmu. Percayakanlah hidupmu ke tangan-Nya, dan biarkan harapan itu menjadi jangkar jiwa di tengah badai kehidupan.</p>',
                'status'       => 'published',
                'published_at' => now()->subDays(14),
            ],
        ];

        foreach ($data as $item) {
            $slug     = Str::slug($item['judul']);
            $original = $slug;
            $n        = 1;
            while (Renungan::where('slug', $slug)->exists()) {
                $slug = $original . '-' . $n++;
            }
            $item['slug'] = $slug;
            Renungan::create($item);
        }
    }
}
