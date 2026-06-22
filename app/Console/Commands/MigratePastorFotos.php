<?php

namespace App\Console\Commands;

use App\Models\Pastor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MigratePastorFotos extends Command
{
    protected $signature = 'migrate:pastor-fotos';
    protected $description = 'Migrate existing Pastor photos from public/ to storage/app/public/';

    public function handle()
    {
        $this->info('Starting migration of Pastor photos...');
        
        $oldPath = public_path('compro_assets/image/pastor');
        $count = 0;
        $errors = 0;

        // Pastikan directory ada
        if (!is_dir($oldPath)) {
            $this->warn('Directory ' . $oldPath . ' tidak ditemukan.');
            return 0;
        }

        $pastors = Pastor::whereNotNull('foto')->get();

        foreach ($pastors as $item) {
            $oldFile = $oldPath . '/' . $item->foto;
            
            if (!file_exists($oldFile)) {
                $this->line("  ⚠ File not found: {$item->foto}");
                $errors++;
                continue;
            }

            try {
                // Generate filename baru dengan random string
                $extension = pathinfo($item->foto, PATHINFO_EXTENSION);
                $newFilename = 'pastor_' . $item->id . '_' . Str::random(8) . '.' . $extension;
                
                // Copy ke storage
                $content = file_get_contents($oldFile);
                Storage::disk('public')->put('pastor/' . $newFilename, $content, 'public');
                
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
            $this->warn("Note: Anda bisa menghapus folder 'compro_assets/image/pastor' dari public/ setelah ini.");
        }

        return 0;
    }
}
