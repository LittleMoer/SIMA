<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
    use HasFactory;

    protected $table = 'armada';
    protected $primaryKey = 'id_armada';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_akun',
        'id_unit',
        'posisi',
        'status'
    ];
    public function akun()
{
    return $this->belongsTo(Akun::class, 'id_akun');
}
public function unit()
{
    return $this->belongsTo(Unit::class, 'id_unit');
}
public function rekapGajiCrew()
{
    return $this->hasMany(RekapGajiCrew::class, 'id_armada', 'id_armada');
}
}
