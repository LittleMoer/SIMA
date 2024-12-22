<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $primaryKey = 'id_unit';
    protected $table = 'unit';
    protected $fillable = [
        'id_unit'
        ,'nama_unit'
        ,'seri_unit'
    ];
    public $timestamps = false;
    public function sj()
    {
        return $this->hasMany(SJ::class, 'id_unit', 'id_unit');
    }
}