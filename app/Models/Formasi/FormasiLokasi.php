<?php

namespace App\Models\Formasi;

use Illuminate\Database\Eloquent\Model;

class FormasiLokasi extends Model
{
    protected $table = 'formasi_lokasi';
    protected $fillable = ['nama_lokasi'];

    public function formasi()
    {
        return $this->hasMany(FormasiPkl::class, 'lokasi_id');
    }
}
