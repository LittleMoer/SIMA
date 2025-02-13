<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spj extends Model
{
    protected $primaryKey = 'id_spj';
    protected $table = 'spj';
    protected $fillable = [
        'id_sj',
        'SaldoEtollawal',
        'SaldoEtollakhir',
        'PenggunaanToll',
        'uanglainlain',
        'uangmakan',
        'totalisibbm',
        'sisabbm',
        'sisasaku',
        'totalsisa',
        'isvalid'
    ];
    public $timestamps = true;

    public function sj()
    {
        return $this->belongsTo(Sj::class, 'id_sj', 'id_sj'); // Foreign key: id_sj, Owner key: id_sj
    }
    public function konsumbbm()
    {
        return $this->hasMany(Konsumbbm::class, 'id_spj', 'id_spj');
    }
}
