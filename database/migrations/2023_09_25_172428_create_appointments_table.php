<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['uncertain', 'certain', 'expired', 'canceled'])->default('uncertain');
            $table->boolean('method');

            $table->foreignId('patient_id')->nullable()->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('reception_id')->nullable()->references('id')->on('receptions')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins')->onDelete('cascade');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreignId('doctor_id')->nullable()->references('id')->on('doctors')->onDelete('cascade');
            $table->foreignId('insurance_id')->nullable()->references('id')->on('insurances')->onDelete('cascade');
            $table->datetime('appointment')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('birth_patient')->nullable();
            $table->string('Blood_Group')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
