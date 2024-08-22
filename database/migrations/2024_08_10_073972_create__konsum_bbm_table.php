<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsumBbmTable extends Migration
{
    public function up()
    {
        Schema::create('konsum_bbm', function (Blueprint $table) {
            $table->id('idkonsumbbm');
            $table->unsignedBigInteger('id_spj');
            $table->foreign('id_spj')->references('id_spj')->on('spj')->onDelete('cascade');
            $table->integer('isiBBM')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('lokasiisi')->nullable();
            $table->integer('totalbayar')->nullable();
            $table->binary('foto_struk')->nullable();
            $table->integer('isvalid');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('konsum_bbm');
    }
}
