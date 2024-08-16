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
        });
    }

    public function down()
    {
        Schema::dropIfExists('armada');
    }
}
