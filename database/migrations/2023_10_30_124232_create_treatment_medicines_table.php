<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('treatment_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_id')->references('id')->on('treatments')->onDelete('cascade');
            $table->foreignId('treatment_medicines_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('treatment_medicines');
    }
}
