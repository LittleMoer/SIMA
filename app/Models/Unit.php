<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $primaryKey = 'id_unit';
    protected $table = 'Unit';
    protected $fillable = [
        'id_unit'
        ,'nama_unit'
        ,'seri_unit'
    ];
    public $timestamps = false;

}