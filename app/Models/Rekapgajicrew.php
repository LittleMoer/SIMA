<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapGajiCrew extends Model
{
    protected $table = 'rekapgajicrew';
    protected $primaryKey = 'id_rekapgajicrew'; 
    protected $fillable = [
        'id_armada', 
        'nama', 
        'bulan', 
        'tanggal', 
        'hari_kerja', 
        'nama_pemesanan', 
        'nilai_kontrak', 
        'bbm', 
        'uang_makan', 
        'parkir',
        'cuci', 
        'toll', 
        'total_operasional', 
        'sisa_nilai_kontrak', 
        'premi', 
        'subsidi', 
        'total_gaji',
        'presentase_premi'
    ];

    public function armada()
    {
        return $this->belongsTo(Armada::class, 'id_armada');
    }
}

