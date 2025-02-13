<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitAvailability extends Model
{
    protected $table = 'unit_availability';
    protected $fillable = ['id_unit', 'date', 'available'];
    public $timestamps = false;

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit', 'id_unit');
    }
}
