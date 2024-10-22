<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsumBbm extends Model
{
    use HasFactory;

    protected $table = 'konsum_bbm';
    protected $primaryKey = 'idkonsumbbm';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idkonsumbbm',  
        'id_spj',       
        'isiBBM',
        'tanggal',
        'lokasiisi',
        'totalbayar',
        'foto_struk',
        'isvalid'
    ];

    public function spj()
    {
        return $this->belongsTo(Spj::class, 'id_spj', 'id_spj');
    }
}

