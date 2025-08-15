<?php

namespace App\Models\Formasi;

use Illuminate\Database\Eloquent\Model;

class FormasiPosisi extends Model
{
    protected $table = 'formasi_posisi';
    protected $fillable = ['nama_posisi'];

    public function formasi()
    {
        return $this->hasMany(FormasiPkl::class, 'posisi_id');
    }
}
