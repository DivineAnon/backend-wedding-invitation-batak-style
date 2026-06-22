<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // for QR code link
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('rsvp_status', ['pending', 'hadir', 'tidak_hadir'])->default('pending');
            $table->integer('attendance_count')->default(1);
            $table->text('message')->nullable();
            $table->enum('language', ['id', 'en'])->default('id');
            $table->string('category')->nullable(); // keluarga, teman, rekan, dll
            $table->boolean('has_opened')->default(false);
            $table->timestamp('opened_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
