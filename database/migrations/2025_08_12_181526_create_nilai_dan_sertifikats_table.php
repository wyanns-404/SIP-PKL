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
        Schema::create('nilai_dan_sertifikat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_pkl_id')->constrained('pelamar_pkl')->cascadeOnDelete();
            $table->string('nilai')->nullable();      // path file nilai
            $table->string('sertifikat')->nullable(); // path file sertifikat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_dan_sertifikat');
    }
};
