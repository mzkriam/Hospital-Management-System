<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulancesTable extends Migration
{
    public function up()
    {
        Schema::create('ambulances', function (Blueprint $table) {
            $table->id();
            $table->string('car_number')->unique();
            $table->string('car_model');
            $table->string('car_year_made');
            $table->string('driver_license_number')->unique();
            $table->string('driver_phone')->unique();
            $table->boolean('is_available')->default(1);
            $table->integer('car_type');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('ambulances');
    }
}
