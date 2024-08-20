<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekapgajicrew', function (Blueprint $table) {
            $table->id('id_rekapgajicrew');
            $table->string('nama');
            $table->integer('armada');
            $table->string('bulan');
            $table->date('tanggal');
            $table->integer('hari_kerja');
            $table->string('pj_rombongan');
            $table->integer('nilai_kontrak');
            $table->integer('bbm')->nullable();
            $table->integer('uang_makan')->nullable();
            $table->integer('parkir')->nullable();
            $table->integer('cuci')->nullable();
            $table->integer('toll')->nullable();
            $table->integer('total_operasional')->nullable();
            $table->integer('sisa_nilai_kontrak')->nullable();
            $table->integer('premi')->nullable();
            $table->integer('subsidi')->nullable();
            $table->integer('total_gaji')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekapgajicrew');
    }
};
