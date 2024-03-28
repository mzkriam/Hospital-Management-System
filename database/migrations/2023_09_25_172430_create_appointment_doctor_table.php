<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentDoctorTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_doctor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreignId('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('appointment_doctor');
    }
}
