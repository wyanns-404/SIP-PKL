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
        Schema::create('formasi_pkl', function (Blueprint $table) {
            $table->id();
            $table->string('nama_formasi');
            $table->foreignId('posisi_id')->constrained('formasi_posisi')->cascadeOnDelete();
            $table->foreignId('lokasi_id')->constrained('formasi_lokasi')->cascadeOnDelete();
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->date('deadline_pendaftaran');
            $table->date('tanggal_pengumuman');
            $table->integer('kuota_penerimaan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formasi_pkl');
    }
};
