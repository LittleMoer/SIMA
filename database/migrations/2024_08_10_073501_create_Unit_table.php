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
        Schema::create('Unit', function (Blueprint $table) {
            $table->id('id_unit');
            $table->string('nama_unit',50);
            $table->integer('seri_unit');
        });
    }                       
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit');
    }
};
