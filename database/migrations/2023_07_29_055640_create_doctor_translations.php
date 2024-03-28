<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorTranslations extends Migration
{
    public function up()
    {
        Schema::create('doctor_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->unique(['doctor_id', 'locale']);

            $table->string('name');

            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('doctor_translations');
    }
}
