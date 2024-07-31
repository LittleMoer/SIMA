<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SJ extends Model
{
    use HasFactory;

    protected $table = 'sj';
    protected $primaryKey = 'id_sj';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_sj',
        'seri_armada',
        'nilai_kontrak',
        'kmsebelum',
        'kmtiba',
        'kasbonbbm',
        'kasbonmakan',
        'lainlain',
    ];
}
