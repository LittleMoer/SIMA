<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPJ extends Model
{
    use HasFactory;

    protected $table = 'spj';
    protected $primaryKey = 'id_spj';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_spj',
        'nolambung',
        'SaldoEtollawal',
        'SaldoEtollakhir',
        'PenggunaanToll',
        'uanglainlain',
        'uangmakan',
        'idkonsumbbm',
        'sisabbm',
        'totalisibbm',
        'sisasaku',
        'totalsisa',
    ];
}
