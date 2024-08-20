<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'Unit';
    protected $fillable = [
        'id_unit'
        ,'nama_unit'
    ];
    public $timestamps = false;

}