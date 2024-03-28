<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationMedicinesTable extends Migration
{

    public function up()
    {
        Schema::create('operation_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operation_id')->references('id')->on('operations')->onDelete('cascade');
            $table->foreignId('operation_medicines_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('operation_medicines');
    }
}
