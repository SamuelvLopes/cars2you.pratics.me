<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleModelsTable extends Migration
{
    public function up()
    {
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicle_models');
    }
}
