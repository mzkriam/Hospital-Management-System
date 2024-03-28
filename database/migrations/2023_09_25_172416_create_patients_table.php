<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->date('Date_Birth');
            $table->string('Phone')->unique();
            $table->string('Gender');
            $table->string('Blood_Group');
            $table->boolean('status')->default(1);
            $table->foreignId('insurance_id')->nullable()->references('id')->on('insurances')->onDelete('cascade');
            $table->foreignId('reception_id')->nullable()->references('id')->on('receptions')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
