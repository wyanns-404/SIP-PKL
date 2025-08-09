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
        // Tabel pelamar_pkl
        Schema::create('pelamar_pkl', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formasi_id')->constrained('formasi_pkl')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('kategori_pelamar', ['siswa', 'mahasiswa']);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('nomor_handphone', 20);
            $table->text('alamat_lengkap');
            $table->text('motivasi')->nullable();
            $table->string('status')->default('dikirim'); // dikirim, diproses, diterima, ditolak
            
            // Path Dokumen
            $table->string('pas_foto')->nullable();
            $table->string('surat_permohonan')->nullable();
            $table->string('portofolio')->nullable();
            $table->string('cv')->nullable();

            $table->timestamps();
        });

        // Tabel pelamar_siswa
        Schema::create('pelamar_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')->constrained('pelamar_pkl')->cascadeOnDelete();
            $table->string('nama_sekolah');
            $table->string('jurusan');
            $table->timestamps();
        });

        // Tabel pelamar_mahasiswa
        Schema::create('pelamar_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')->constrained('pelamar_pkl')->cascadeOnDelete();
            $table->string('nama_universitas');
            $table->string('fakultas');
            $table->string('jurusan');
            $table->unsignedTinyInteger('semester');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamar_mahasiswa');
        Schema::dropIfExists('pelamar_siswa');
        Schema::dropIfExists('pelamar_pkl');
    }
};
