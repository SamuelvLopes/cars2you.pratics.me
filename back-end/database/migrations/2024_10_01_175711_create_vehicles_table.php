<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->integer('manufacture_year');
            $table->float('weight', 8, 2);
            $table->string('photo')->default('https://via.placeholder.com/150x150');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('model_id')->references('id')->on('vehicle_models')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
