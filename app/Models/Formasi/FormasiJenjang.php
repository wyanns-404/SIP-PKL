<?php

namespace App\Models\Formasi;

use Illuminate\Database\Eloquent\Model;

class FormasiJenjang extends Model
{
    protected $table = 'formasi_jenjang';
    protected $fillable = ['nama_jenjang'];

    public function formasi()
    {
        return $this->belongsToMany(FormasiPkl::class, 'formasi_pkl_jenjang', 'jenjang_id', 'formasi_id');
    }
}
