<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaranUangSakuTable extends Migration
{
    public function up()
{
    Schema::create('pengeluaran_uang_saku', function (Blueprint $table) {
        $table->bigIncrements('id_pengeluaran');  // Menggunakan auto-increment
        $table->unsignedBigInteger('id_spj')->unique();
        $table->foreign('id_spj')->references('id_spj')->on('spj')->onDelete('cascade');
        $table->integer('nominal');
        $table->string('catatan');
        $table->text('deskripsi')->nullable();
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('pengeluaran_uang_saku');
    }
}
