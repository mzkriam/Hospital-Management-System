<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->unique();
            $table->uuid('job_number');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->integer('number_of_statements');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
