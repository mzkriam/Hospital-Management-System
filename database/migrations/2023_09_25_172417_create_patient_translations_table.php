<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('patient_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->unique(['patient_id', 'locale']);
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');

            $table->string('name');
            $table->string('Address');
        });
    }
    public function down()
    {
        Schema::dropIfExists('patient_translations');
    }
}
