<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSjTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sj', function (Blueprint $table) {
            $table->string('id_sj', 20)->primary();
            $table->string('seri_armada', 10);
            $table->integer('nilai_kontrak');
            $table->string('kmsebelum', 255);
            $table->string('kmtiba', 255)->nullable();
            $table->string('kasbonbbm', 255);
            $table->string('kasbonmakan', 255);
            $table->text('lainlain')->nullable();
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
        Schema::dropIfExists('sj');
    }
}
