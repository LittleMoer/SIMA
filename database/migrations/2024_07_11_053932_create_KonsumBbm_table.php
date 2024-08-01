<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsumBbmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsum_bbm', function (Blueprint $table) {
            $table->string('idkonsumbbm', 20)->primary();
            $table->integer('isiBBM')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('lokasiisi', 255)->nullable();
            $table->integer('totalbayar')->nullable();
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
        Schema::dropIfExists('konsum_bbm');
    }
}
