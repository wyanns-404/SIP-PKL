<?php

namespace App\Models\Formasi;

use Illuminate\Database\Eloquent\Model;

class FormasiPkl extends Model
{
    protected $table = 'formasi_pkl';
    protected $fillable = [
        'nama_formasi', 'posisi_id', 'lokasi_id', 'deskripsi',
        'tanggal_mulai', 'tanggal_selesai', 'deadline_pendaftaran',
        'tanggal_pengumuman', 'kuota_penerimaan'
    ];

    public function posisi()
    {
        return $this->belongsTo(FormasiPosisi::class, 'posisi_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(FormasiLokasi::class, 'lokasi_id');
    }

    public function jenjang()
    {
        return $this->belongsToMany(FormasiJenjang::class, 'formasi_pkl_jenjang', 'formasi_id', 'jenjang_id');
    }

    public function jurusan()
    {
        return $this->belongsToMany(FormasiJurusan::class, 'formasi_pkl_jurusan', 'formasi_id', 'jurusan_id');
    }
}
