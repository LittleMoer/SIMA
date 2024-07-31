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

    protected $fillable = [
        'id_armada',
        'driver',
        'codriver',
    ];
}
