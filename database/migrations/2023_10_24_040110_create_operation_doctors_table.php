<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('operation_doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operation_id')->references('id')->on('operations')->onDelete('cascade');
            $table->foreignId('operation_doctors_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('operation_doctors');
    }
}
