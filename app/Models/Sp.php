<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sp extends Model
{
    protected $primaryKey = 'id_sp';
    protected $table = 'sp';
    // protected $primaryKey = 'id_sp';
    protected $fillable = [
        'nama_pemesan', 'marketing' ,'no_telppn', 'pj_rombongan', 'no_telpps', 'tujuan', 'alamat_penjemputan', 
        'jumlah_armada', 'nilai_kontrak1','nilai_kontrak2', 'biaya_tambahan', 'total_biaya', 'uang_muka', 'status_pembayaran',
        'sisa_pembayaran', 'metode_pembayaran', 'catatan_pembayaran', 'tgl_keberangkatan', 'jam_keberangkatan',
        'tgl_kepulangan', 'jam_kepulangan'
    ];
    public $timestamps = true;

    public function sj()
    {
        return $this->hasMany(Sj::class, 'id_sp', 'id_sp');
    }
}