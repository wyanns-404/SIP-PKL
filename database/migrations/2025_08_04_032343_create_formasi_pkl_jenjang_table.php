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
        Schema::create('formasi_pkl_jenjang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formasi_id')->constrained('formasi_pkl')->cascadeOnDelete();
            $table->foreignId('jenjang_id')->constrained('formasi_jenjang')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formasi_pkl_jenjang');
    }
};
