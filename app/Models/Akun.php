<?php
// app/Models/Akun.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Akun extends Authenticatable
{
    use Notifiable;

    protected $table = 'akun'; 
    protected $primaryKey = 'id_akun'; 
    
    protected $fillable = [
        'username', 'name', 'email', 'role_id', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
