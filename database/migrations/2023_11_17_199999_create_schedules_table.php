<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{

    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->nullable()->references('id')->on('doctors')->onDelete('cascade');
            $table->foreignId('lab_employee_id')->nullable()->references('id')->on('lab_employees')->onDelete('cascade');
            $table->foreignId('ray_employee_id')->nullable()->references('id')->on('ray_employees')->onDelete('cascade');
            $table->foreignId('pha_employee_id')->nullable()->references('id')->on('pha_employees')->onDelete('cascade');
            $table->foreignId('reception_id')->nullable()->references('id')->on('receptions')->onDelete('cascade');
            $table->foreignId('accounting_id')->nullable()->references('id')->on('accountings')->onDelete('cascade');
            $table->string('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
