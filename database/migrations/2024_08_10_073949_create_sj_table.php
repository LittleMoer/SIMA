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
            $table->unsignedBigInteger('id_unit')->nullable();
            $table->foreign('id_unit')->references('id_unit')->on('Unit')->onDelete('cascade');
            $table->string('driver', 50)->nullable();
            $table->string('codriver', 50)->nullable();
            $table->integer('kmsebelum')->nullable();
            $table->integer('kmtiba')->nullable();
            $table->integer('kasbonbbm')->nullable();
            $table->integer('kasbonmakan')->nullable();
            $table->text('lainlain')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sj');
    }
}