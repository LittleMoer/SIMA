<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spj extends Model
{
    protected $table = 'spj';
    protected $fillable = [
        'id_sj', 'SaldoEtollawal', 'SaldoEtollakhir', 'PenggunaanToll', 'uanglainlain', 
        'uangmakan', 'sisabbm', 'totalisibbm', 'sisasaku', 'totalsisa'
    ];
    public $timestamps = true;

    public function sj()
    {
        return $this->belongsTo(SJ::class);
    }
}
