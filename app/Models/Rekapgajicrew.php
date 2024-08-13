<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapGajiCrew extends Model
{
    use HasFactory;

    protected $table = 'rekapgajicrew';

    // Indicate that the primary key is not an auto-incrementing integer
    public $incrementing = false;

    public $timestamps = false;

    // Set the data type for the primary key
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'crew',
        'bulan',
        'no',
        'tanggal',
        'pj_rombongan',
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
        'total_gaji'
    ];
}
