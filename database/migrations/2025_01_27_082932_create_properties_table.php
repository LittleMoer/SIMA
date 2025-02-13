<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jenis');
            $table->integer('lt');
            $table->integer('lb');
            $table->integer('km');
            $table->integer('kt');
            $table->string('lokasi');
            $table->bigInteger('harga');
            $table->string('no_hp');
            $table->string('whatsapp');
            $table->json('gambar')->nullable(); // Ubah menjadi JSON
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
