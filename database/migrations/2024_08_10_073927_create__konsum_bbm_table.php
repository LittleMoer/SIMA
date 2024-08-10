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
            $table->integer('isiBBM')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('lokasiisi')->nullable();
            $table->integer('totalbayar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('konsum_bbm');
    }
}
