<?php

namespace App\Models\Formasi;

use Illuminate\Database\Eloquent\Model;

class FormasiJurusan extends Model
{
    protected $table = 'formasi_jurusan';
    protected $fillable = ['nama_jurusan'];

    public function formasi()
    {
        return $this->belongsToMany(FormasiPkl::class, 'formasi_pkl_jurusan', 'jurusan_id', 'formasi_id');
    }
}
