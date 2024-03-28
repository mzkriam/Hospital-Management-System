<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->decimal('price', 8, 2);
            $table->foreignId('pha_employee_id')->nullable()->references('id')->on('pha_employees')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins')->onDelete('cascade');
            $table->enum('status', [0, 1])->default(1);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
