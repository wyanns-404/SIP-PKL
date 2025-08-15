<?php

namespace App\Models\Pelamar;

use App\Models\User;
use App\Models\Formasi\FormasiPkl;
use App\Models\NilaiDanSertifikat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PelamarPkl extends Model
{
    protected $table = 'pelamar_pkl';

    protected $fillable = [
        'formasi_id',
        'user_id',
        'kategori_pelamar',
        'tanggal_lahir',
        'jenis_kelamin',
        'nomor_handphone',
        'alamat_lengkap',
        'motivasi',
        'status',
        'pas_foto',
        'surat_permohonan',
        'portofolio',
        'cv',
    ];

    public function siswa(): HasOne
    {
        return $this->hasOne(PelamarSiswa::class, 'pelamar_id');
    }

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(PelamarMahasiswa::class, 'pelamar_id');
    }

    public function formasi(): BelongsTo
    {
        return $this->belongsTo(FormasiPkl::class, 'formasi_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nilaiDanSertifikat()
    {
        return $this->hasOne(NilaiDanSertifikat::class, 'pelamar_pkl_id');
    }

}