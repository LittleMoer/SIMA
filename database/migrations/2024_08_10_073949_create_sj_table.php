<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSjTable extends Migration
{
    public function up()
    {
        Schema::create('sj', function (Blueprint $table) {
            $table->id('id_sj');
            $table->unsignedBigInteger('id_sp');
            $table->foreign('id_sp')->references('id_sp')->on('sp')->onDelete('cascade');
            $table->unsignedBigInteger('id_armada')->nullable();
            $table->foreign('id_armada')->references('id_armada')->on('armada')->onDelete('cascade');
            $table->integer('nilai_kontrak');
            $table->string('kmsebelum', 255);
            $table->string('kmtiba', 255)->nullable();
            $table->string('kasbonbbm', 255);
            $table->string('kasbonmakan', 255);
            $table->text('lainlain')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sj');
    }
}
