<?php

namespace App\Console\Commands;

use App\Models\Sejarah;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MigrateSejarahFotos extends Command
{
    protected $signature = 'migrate:sejarah-fotos';
    protected $description = 'Migrate existing Sejarah hero images from public/ to storage/app/public/';

    public function handle()
    {
        $this->info('Starting migration of Sejarah hero images...');
        
        $oldPath = public_path('compro_assets/image');
        $count = 0;
        $errors = 0;

        // Pastikan directory ada
        if (!is_dir($oldPath)) {
            $this->warn('Directory ' . $oldPath . ' tidak ditemukan.');
            return 0;
        }

        $sejarah = Sejarah::whereNotNull('hero_image')
            ->where('hero_image', '!=', 'hero.jpg')
            ->get();

        foreach ($sejarah as $item) {
            $oldFile = $oldPath . '/' . $item->hero_image;
            
            if (!file_exists($oldFile)) {
                $this->line("  ⚠ File not found: {$item->hero_image}");
                $errors++;
                continue;
            }

            try {
                // Generate filename baru dengan random string
                $extension = pathinfo($item->hero_image, PATHINFO_EXTENSION);
                $newFilename = 'sejarah_hero_' . $item->id . '_' . Str::random(8) . '.' . $extension;
                
                // Copy ke storage
                $content = file_get_contents($oldFile);
                Storage::disk('public')->put('sejarah/' . $newFilename, $content, 'public');
                
                // Update database
                $item->update(['hero_image' => $newFilename]);
                
                // Delete file lama (optional, uncomment jika ingin delete)
                // unlink($oldFile);
                
                $this->line("  ✓ Migrated: Sejarah ({$item->hero_image} → {$newFilename})");
                $count++;
            } catch (\Exception $e) {
                $this->error("  ✗ Error migrating {$item->hero_image}: " . $e->getMessage());
                $errors++;
            }
        }

        $this->info("Migration complete!");
        $this->line("  Migrated: $count");
        $this->line("  Errors: $errors");
        
        if ($errors === 0 && $count > 0) {
            $this->info("✓ All hero images migrated successfully!");
        } elseif ($count === 0) {
            $this->info("ℹ No hero images to migrate.");
        }

        return 0;
    }
}
