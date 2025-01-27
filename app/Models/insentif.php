<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insentif extends Model
{
    use HasFactory;

    protected $table = 'insentif'; // Nama tabel
    protected $primaryKey = 'id_insentif'; // Primary key

    protected $fillable = [
        'nama',
        'bulan',
        'insentif',
        'tahun'
    ];
}