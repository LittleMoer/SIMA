<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunTable extends Migration
{
    public function up()
    {
        Schema::create('akun', function (Blueprint $table) {
            $table->id('id_akun');
            $table->string('username', 255)->unique();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->integer('role_id');
            $table->unsignedBigInteger('id_armada')->nullable();
            $table->foreign('id_armada')->references('id_armada')->on('armada')->onDelete('cascade');
            $table->string('password', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('akun');
    }
}
