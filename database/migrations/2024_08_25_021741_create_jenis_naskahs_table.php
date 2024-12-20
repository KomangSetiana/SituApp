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
        Schema::create('jenis_naskahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('naskah_id')->constrained('naskahs')->onDelete('cascade');
            $table->string('kode');
            $table->string('nama');
            $table->boolean('akses_naskah')->nullable()->default(0);
            $table->boolean('has_direktur')->nullable()->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_naskahs');
    }
};
