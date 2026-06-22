<?php

namespace App\Console\Commands;

use App\Models\DewanParoki;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MigrateDewanParokiFotos extends Command
{
    protected $signature = 'migrate:dewan-paroki-fotos';
    protected $description = 'Migrate existing DewanParoki photos from public/ to storage/app/public/';

    public function handle()
    {
        $this->info('Starting migration of DewanParoki photos...');
        
        $oldPath = public_path('compro_assets/image/dewan-paroki');
        $count = 0;
        $errors = 0;

        // Pastikan directory ada
        if (!is_dir($oldPath)) {
            $this->warn('Directory ' . $oldPath . ' tidak ditemukan.');
            return 0;
        }

        $anggota = DewanParoki::whereNotNull('foto')->get();

        foreach ($anggota as $item) {
            $oldFile = $oldPath . '/' . $item->foto;
            
            if (!file_exists($oldFile)) {
                $this->line("  ⚠ File not found: {$item->foto}");
                $errors++;
                continue;
            }

            try {
                // Generate filename baru dengan random string
                $extension = pathinfo($item->foto, PATHINFO_EXTENSION);
                $newFilename = 'dewan_' . $item->id . '_' . Str::random(8) . '.' . $extension;
                
                // Copy ke storage
                $content = file_get_contents($oldFile);
                Storage::disk('public')->put('dewan-paroki/' . $newFilename, $content, 'public');
                
                // Update database
                $item->update(['foto' => $newFilename]);
                
                // Delete file lama (optional, uncomment jika ingin delete)
                // unlink($oldFile);
                
                $this->line("  ✓ Migrated: {$item->nama} ({$item->foto} → {$newFilename})");
                $count++;
            } catch (\Exception $e) {
                $this->error("  ✗ Error migrating {$item->foto}: " . $e->getMessage());
                $errors++;
            }
        }

        $this->info("Migration complete!");
        $this->line("  Migrated: $count");
        $this->line("  Errors: $errors");
        
        if ($errors === 0 && $count > 0) {
            $this->info("✓ All photos migrated successfully!");
            $this->warn("Note: Anda bisa menghapus folder 'compro_assets/image/dewan-paroki' dari public/ setelah ini.");
        }

        return 0;
    }
}
