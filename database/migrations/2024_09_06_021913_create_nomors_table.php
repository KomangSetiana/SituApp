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
        Schema::create('nomors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jabatan_id')->constrained('jabatans')->onDelete('cascade');
            $table->foreignId('jenis_naskah_id')->constrained('jenis_naskahs')->onDelete('cascade');
            $table->foreignId('klasifikasi_id')->constrained('klasifikasis')->onDelete('cascade');
            $table->string('id_pengguna');  // This will be the foreign key column
            // Create a foreign key reference on the `id_pengguna` column instead of the `id`
            $table->foreign('id_pengguna')->references('id_pengguna')->on('users')->onDelete('cascade');
            $table->date('tanggal_surat');
            $table->string('nomor_surat');
            $table->string('tujuan');
            $table->text('perihal');
            $table->foreignId('plh_id')->nullable()->constrained('plhs')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('filename')->nullable();
            $table->boolean('tipe')->default(0);
            $table->foreignId('akses_naskah')->nullable()->constrained('akses_naskahs')->onDelete('cascade');
            $table->string('proses_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomors');
    }
};
