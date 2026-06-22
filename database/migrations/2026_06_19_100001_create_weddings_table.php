<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->string('couple_name_1');
            $table->string('couple_name_2');
            $table->string('marga_1')->nullable(); // Batak marga
            $table->string('marga_2')->nullable();
            $table->text('bio_1')->nullable();
            $table->text('bio_2')->nullable();
            $table->string('photo_1')->nullable();
            $table->string('photo_2')->nullable();
            $table->date('akad_date');
            $table->time('akad_time');
            $table->string('akad_venue');
            $table->text('akad_address');
            $table->date('resepsi_date');
            $table->time('resepsi_time');
            $table->string('resepsi_venue');
            $table->text('resepsi_address');
            $table->string('maps_url')->nullable();
            $table->text('love_story')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('music_url')->nullable();
            $table->string('music_title')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weddings');
    }
};
