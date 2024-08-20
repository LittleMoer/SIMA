<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmadaTable extends Migration
{
    public function up()
    {
        Schema::create('armada', function (Blueprint $table) {
            $table->id('id_armada');
            $table->unsignedBigInteger('id_akun');
            $table->foreign('id_akun')->references('id_akun')->on('akun')->onDelete('cascade');
            $table->unsignedBigInteger('id_unit');
            $table->foreign('id_unit')->references('id_unit')->on('unit')->onDelete('cascade');
            $table->string('posisi', 100);
            $table->integer('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('armada');
    }
}
