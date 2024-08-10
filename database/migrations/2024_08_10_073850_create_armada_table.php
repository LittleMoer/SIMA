<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmadaTable extends Migration
{
    public function up()
    {
        Schema::create('armada', function (Blueprint $table) {
            $table->id('id_armada');
            $table->string('driver', 50)->nullable();
            $table->string('codriver', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('armada');
    }
}
