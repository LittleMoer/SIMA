<?php
// app/Models/Akun.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Akun extends Authenticatable
{
    // Jika Anda menggunakan field lain untuk username, pastikan menambahkan properti yang sesuai
    protected $fillable = [
        'username'
        , 'name'
        , 'email'
        , 'password'
        , 'role_id'
    ];

    // Jika Anda ingin menentukan field untuk username yang digunakan dalam proses login
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthIdentifierName()
    {
        return 'username'; // atau 'id_akun' jika menggunakan id
    }
    protected $table = 'akun';
}
