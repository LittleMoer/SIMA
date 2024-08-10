<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SP extends Model
{
    protected $table = 'sp';
    protected $fillable = [
        'nama_pemesan', 'no_telppn', 'pj_rombongan', 'no_telpps', 'tujuan', 'alamat_penjemputan', 
        'jumlah_armada', 'nilai_kontrak', 'biaya_tambahan', 'total_biaya', 'uang_muka', 'status_pembayaran',
        'sisa_pembayaran', 'metode_pembayaran', 'catatan_pembayaran', 'tgl_keberangkatan', 'jam_keberangkatan',
        'tgl_kepulangan', 'jam_kepulangan', 'id_spj', 'id_sj'
    ];
    public $timestamps = true;

    public function spj()
    {
        return $this->belongsTo(SPJ::class, 'id_spj');
    }

    public function sj()
    {
        return $this->belongsTo(SJ::class, 'id_sj');
    }
}
