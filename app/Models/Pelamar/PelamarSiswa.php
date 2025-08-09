<?php

namespace App\Models\Pelamar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PelamarSiswa extends Model
{
    protected $table = 'pelamar_siswa';

    protected $fillable = [
        'pelamar_id',
        'nama_sekolah',
        'jurusan',
    ];

    public function pelamar(): BelongsTo
    {
        return $this->belongsTo(PelamarPkl::class, 'pelamar_id');
    }
}