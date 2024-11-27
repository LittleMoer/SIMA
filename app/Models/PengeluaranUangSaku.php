<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranUangSaku extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran_uang_saku';
    protected $primaryKey = 'id_pengeluaran';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pengeluaran',
        'id_spj',
        'nominal',
        'catatan',
        'deskripsi',
    ];

    public function spj()
    {
        return $this->belongsTo(Spj::class, 'id_spj', 'id_spj');
    }
}
