<?php

namespace App\Models\Pelamar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PelamarMahasiswa extends Model
{
    protected $table = 'pelamar_mahasiswa';

    protected $fillable = [
        'pelamar_id',
        'nama_universitas',
        'fakultas',
        'jurusan',
        'semester',
    ];

    public function pelamar(): BelongsTo
    {
        return $this->belongsTo(PelamarPkl::class, 'pelamar_id');
    }
}