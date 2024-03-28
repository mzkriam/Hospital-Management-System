<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('patients_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('patients_medicines');
    }
}
