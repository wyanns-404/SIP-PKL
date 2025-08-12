<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Pelamar\PelamarPkl;

class NilaiDanSertifikat extends Model
{
    use HasFactory;

    protected $table = 'nilai_dan_sertifikat';

    protected $fillable = [
        'pelamar_pkl_id',
        'nilai',
        'sertifikat',
    ];

    public function pelamar()
    {
        return $this->belongsTo(PelamarPkl::class, 'pelamar_pkl_id');
    }
}
