<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpTable extends Migration
{
    public function up()
    {
        Schema::create('sp', function (Blueprint $table) {
            $table->id('id_sp');
            $table->string('nama_pemesan', 50);
            $table->string('pj_rombongan', 50);
            $table->string('no_telppn', 13);
            $table->string('no_telpps', 13);
            $table->date('tgl_keberangkatan');
            $table->time('jam_keberangkatan');
            $table->date('tgl_kepulangan');
            $table->time('jam_kepulangan');
            $table->string('tujuan', 20);
            $table->string('alamat_penjemputan', 100);
            $table->integer('jumlah_armada');
            $table->integer('nilai_kontrak1');
            $table->integer('nilai_kontrak2')->nullable();
            $table->integer('biaya_tambahan')->nullable();
            $table->integer('total_biaya');
            $table->integer('uang_muka');
            $table->integer('status_pembayaran');
            $table->string('metode_pembayaran', 10);
            $table->integer('sisa_pembayaran')->nullable();
            $table->text('catatan_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sp');
    }
}
