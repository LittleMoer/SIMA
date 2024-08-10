<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SPJ extends Model
{
    protected $table = 'spj';
    protected $fillable = [
        'nolambung', 'SaldoEtollawal', 'SaldoEtollakhir', 'PenggunaanToll', 'uanglainlain', 
        'uangmakan', 'idkonsumbbm', 'sisabbm', 'totalisibbm', 'sisasaku', 'totalsisa'
    ];
    public $timestamps = true;

    public function sp()
    {
        return $this->hasOne(SP::class, 'id_spj');
    }
}
