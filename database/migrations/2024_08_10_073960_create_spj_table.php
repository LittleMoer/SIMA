<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpjTable extends Migration
{
    public function up()
    {
        Schema::create('spj', function (Blueprint $table) {
            $table->id('id_spj');
            $table->unsignedBigInteger('id_sj');
            $table->foreign('id_sj')->references('id_sj')->on('sj')->onDelete('cascade');
            $table->unsignedBigInteger('id_armada')->nullable();
            $table->foreign('id_armada')->references('id_armada')->on('armada')->onDelete('cascade');
            $table->integer('SaldoEtollawal')->nullable();
            $table->integer('SaldoEtollakhir')->nullable();
            $table->integer('PenggunaanToll')->nullable();
            $table->integer('uanglainlain')->nullable();
            $table->integer('uangmakan')->nullable();
            $table->Integer('idkonsumbbm');
            $table->integer('sisabbm')->nullable();
            $table->integer('totalisibbm')->nullable();
            $table->integer('sisasaku')->nullable();
            $table->integer('totalsisa')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spj');
    }
}
