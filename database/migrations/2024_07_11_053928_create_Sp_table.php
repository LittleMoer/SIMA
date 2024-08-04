<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sp', function (Blueprint $table) {
            $table->string('id_sp', 200)->primary();
            $table->string('nama_pemesan', 50);
            $table->string('pj_rombongan', 50);
            $table->string('no_telppn', 12);
            $table->string('no_telpps', 12);
            $table->date('tgl_keberangkatan');
            $table->time('jam_keberangkatan');
            $table->date('tgl_kepulangan');
            $table->time('jam_kepulangan');
            $table->string('tujuan', 20);
            $table->string('alamat_penjemputan', 100);
            $table->integer('jumlah_armada');
            $table->integer('nilai_kontrak');
            $table->integer('biaya_tambahan');
            $table->integer('total_biaya');
            $table->integer('uang_muka');
            $table->integer('status_pembayaran', 1);
            $table->integer('sisa_pembayaran')->nullable();
            $table->text('catatan_pembayaran')->nullable();
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
        Schema::dropIfExists('sp');
    }
}
