<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitAvailability extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_availability', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->foreignId('id_unit')->constrained('unit')->onDelete('cascade'); // Foreign key ke tabel units
            $table->date('date'); // Tanggal ketersediaan
            $table->tinyInteger('available'); // Status ketersediaan (tersedia/tidak tersedia)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_availability');
    }
}
