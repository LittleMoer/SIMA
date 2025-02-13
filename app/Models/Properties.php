<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jenis',
        'lt',
        'lb',
        'km',
        'kt',
        'lokasi',
        'harga',
        'no_hp',
        'whatsapp',
        'gambar',
    ];
}
