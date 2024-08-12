<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SPJ extends Model
{
    protected $table = 'spj';
    protected $fillable = [
        'id_sj','nolambung', 'SaldoEtollawal', 'SaldoEtollakhir', 'PenggunaanToll', 'uanglainlain', 
        'uangmakan', 'idkonsumbbm', 'sisabbm', 'totalisibbm', 'sisasaku', 'totalsisa'
    ];
    public $timestamps = true;

    public function sj()
    {
        return $this->belongsTo(SJ::class);
    }
    public function konsumbbm()
    {
        return $this->hasMany(konsumbbm::class);
    }
}
