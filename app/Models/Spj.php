<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SPJ extends Model
{
    protected $table = 'spj';
    protected $fillable = [
        'id_sj','id_armada', 'SaldoEtollawal', 'SaldoEtollakhir', 'PenggunaanToll', 'uanglainlain', 
        'uangmakan', 'idkonsumbbm', 'sisabbm', 'totalisibbm', 'sisasaku', 'totalsisa'
    ];
    public $timestamps = true;

    public function sj()
    {
        return $this->belongsTo(SJ::class);
    }
}
