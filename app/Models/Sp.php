<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SP extends Model
{
    use HasFactory;

    protected $table = 'sp';
    protected $primaryKey = 'id_sp';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_sp',
        'nama_pemesan',
        'pj_rombongan',
        'no_telppn',
        'no_telpps',
        'tgl_keberangkatan',
        'jam_keberangkatan',
        'tgl_kepulangan',
        'jam_kepulangan',
        'tujuan',
        'alamat_penjemputan',
        'jumlah_armada',
        'nilai_kontrak',
        'biaya_tambahan',
        'total_biaya',
        'uang_muka',
        'status_pembayaran',
        'sisa_pembayaran',
        'catatan_pembayaran',
    ];
}
