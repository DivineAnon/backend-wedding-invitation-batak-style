<?php

namespace Database\Seeders;

use App\Models\Unduhan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnduhanSeeder extends Seeder
{
    public function run(): void
    {
        $dir = public_path('compro_assets/unduhan');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // Minimal valid PDF bytes (128-byte minimal PDF)
        $minimalPdf = "%PDF-1.4\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n"
            . "2 0 obj<</Type/Pages/Kids[3 0 R]/Count 1>>endobj\n"
            . "3 0 obj<</Type/Page/MediaBox[0 0 612 792]/Parent 2 0 R>>endobj\n"
            . "xref\n0 4\n0000000000 65535 f \n0000000009 00000 n \n"
            . "0000000058 00000 n \n0000000115 00000 n \n"
            . "trailer<</Size 4/Root 1 0 R>>\nstartxref\n200\n%%EOF";

        $csvContent = "No,Nama,Keterangan\n1,Contoh Data,Data umat paroki\n2,Santo Yoseph,Paroki Matraman\n";

        $dokumenItems = [
            ['judul' => 'Formulir Data KK-Kep BIDUK', 'deskripsi' => 'Formulir pengisian data kepala keluarga untuk sistem BIDUK', 'ext' => 'pdf', 'content' => $minimalPdf],
            ['judul' => 'Formulir Baptisan Bayi-Anak', 'deskripsi' => 'Formulir pendaftaran sakramen baptis untuk bayi dan anak', 'ext' => 'pdf', 'content' => $minimalPdf],
            ['judul' => 'Formulir Pendaftaran Perkawinan', 'deskripsi' => 'Formulir pendaftaran dan persyaratan sakramen perkawinan', 'ext' => 'pdf', 'content' => $minimalPdf],
            ['judul' => 'Formulir Komuni Pertama', 'deskripsi' => 'Formulir pendaftaran penerimaan komuni pertama', 'ext' => 'pdf', 'content' => $minimalPdf],
            ['judul' => 'Data Umat Lingkungan', 'deskripsi' => 'Template spreadsheet data umat per lingkungan', 'ext' => 'csv', 'content' => $csvContent],
            ['judul' => 'Pedoman Dasar Dewan Paroki 2022–2026', 'deskripsi' => 'Pedoman dasar dan tata kelola dewan paroki periode 2022–2026', 'ext' => 'pdf', 'content' => $minimalPdf],
        ];

        $majalahItems = [
            ['judul' => 'Majalah Obor Edisi Januari 2025', 'deskripsi' => 'Edisi perdana tahun 2025 — Tema: Berjalan Bersama', 'ext' => 'pdf', 'content' => $minimalPdf],
            ['judul' => 'Majalah Obor Edisi Februari 2025', 'deskripsi' => 'Edisi Februari 2025 — Tema: Keluarga Kudus', 'ext' => 'pdf', 'content' => $minimalPdf],
            ['judul' => 'Majalah Obor Edisi Maret 2025', 'deskripsi' => 'Edisi Maret 2025 — Tema: Masa Prapaska', 'ext' => 'pdf', 'content' => $minimalPdf],
            ['judul' => 'Majalah Obor Edisi Desember 2024', 'deskripsi' => 'Edisi Natal 2024 — Tema: Cahaya Harapan', 'ext' => 'pdf', 'content' => $minimalPdf],
        ];

        DB::table('unduhan')->truncate();

        $urutan = 1;
        foreach ($dokumenItems as $item) {
            $filename = 'dummy_dokumen_' . $urutan . '.' . $item['ext'];
            $path = $dir . '/' . $filename;
            file_put_contents($path, $item['content']);
            $size = filesize($path);

            Unduhan::create([
                'judul'         => $item['judul'],
                'deskripsi'     => $item['deskripsi'],
                'kategori'      => 'dokumen',
                'nama_file'     => $filename,
                'original_name' => $item['judul'] . '.' . $item['ext'],
                'mime_type'     => $item['ext'] === 'pdf' ? 'application/pdf' : 'text/csv',
                'ukuran'        => $size,
                'urutan'        => $urutan,
            ]);
            $urutan++;
        }

        $urutan = 1;
        foreach ($majalahItems as $item) {
            $filename = 'dummy_majalah_' . $urutan . '.' . $item['ext'];
            $path = $dir . '/' . $filename;
            file_put_contents($path, $item['content']);
            $size = filesize($path);

            Unduhan::create([
                'judul'         => $item['judul'],
                'deskripsi'     => $item['deskripsi'],
                'kategori'      => 'majalah',
                'nama_file'     => $filename,
                'original_name' => $item['judul'] . '.' . $item['ext'],
                'mime_type'     => 'application/pdf',
                'ukuran'        => $size,
                'urutan'        => $urutan,
            ]);
            $urutan++;
        }
    }
}
