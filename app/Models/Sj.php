<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SJ extends Model
{
    protected $table = 'sj';
    protected $fillable = [
        'id_sp','seri_armada', 'nilai_kontrak', 'kmsebelum', 'kmtiba', 'kasbonbbm', 'kasbonmakan', 'lainlain'
    ];
    public $timestamps = true;

    public function sp()
    {
        return $this->belongsTo(SP::class);
    }
}
