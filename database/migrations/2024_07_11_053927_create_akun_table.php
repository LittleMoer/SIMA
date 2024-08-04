<?php
// database/migrations/xxxx_xx_xx_create_akun_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunTable extends Migration
{
    public function up()
    {
        Schema::create('akun', function (Blueprint $table) {
            $table->id('id_akun'); // Auto-increment primary key
            $table->string('username', 255)->unique();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->integer('role_id');
            $table->string('password', 255);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('akun');
    }
}
