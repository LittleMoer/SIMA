<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sj extends Model
{
    protected $primaryKey = 'id_sj';
    protected $table = 'sj';
    protected $fillable = [
        'id_sp'
        ,'id_unit'
        , 'driver'
        , 'codriver'
        , 'kmsebelum'
        , 'kmtiba'
        , 'kasbonbbm'
        , 'kasbonmakan'
        , 'lainlain'
    ];
    public $timestamps = true;

    public function sp()
    {
        return $this->belongsTo(SP::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function spj()
    {
        return $this->hasOne(Spj::class);
    }
}