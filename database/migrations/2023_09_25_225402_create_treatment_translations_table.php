<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('treatment_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('treatment_id')->references('id')->on('treatments')->onDelete('cascade');
            $table->unique(['locale', 'treatment_id']);

            $table->string('name');
            $table->longText('description');
            $table->longText('procedures')->nullable();
            $table->longText('warnings')->nullable();
            $table->longText('side_effects')->nullable();
            $table->longText('results')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('treatment_translations');
    }
}
