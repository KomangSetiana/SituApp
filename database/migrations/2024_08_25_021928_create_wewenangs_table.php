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
        Schema::create('wewenangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jabatan_id')->constrained('jabatans')->onDelete('cascade');
            $table->foreignId('jenis_naskah_id')->constrained('jenis_naskahs')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wewenangs');
    }
};
