<?php
// app/Models/Akun.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Akun extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'akun'; 
    protected $primaryKey = 'id_akun';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'username'
        , 'name'
        , 'email'
        , 'role_id'
        , 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
