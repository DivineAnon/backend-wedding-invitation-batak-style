<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->boolean('attended_church')->default(false);
            $table->timestamp('church_scanned_at')->nullable();
            $table->boolean('attended_reception')->default(false);
            $table->timestamp('reception_scanned_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->dropColumn([
                'attended_church',
                'church_scanned_at',
                'attended_reception',
                'reception_scanned_at'
            ]);
        });
    }
};
