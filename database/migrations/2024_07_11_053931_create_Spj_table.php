<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpjTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spj', function (Blueprint $table) {
            $table->id();
            $table->string('nolambung', 20);
            $table->integer('SaldoEtollawal')->nullable();
            $table->integer('SaldoEtollakhir')->nullable();
            $table->integer('PenggunaanToll')->nullable();
            $table->integer('uanglainlain')->nullable();
            $table->integer('uangmakan')->nullable();
            $table->string('idkonsumbbm', 20);
            $table->integer('sisabbm')->nullable();
            $table->integer('totalisibbm')->nullable();
            $table->integer('sisasaku')->nullable();
            $table->integer('totalsisa')->nullable();
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
        Schema::dropIfExists('spj');
    }
}
