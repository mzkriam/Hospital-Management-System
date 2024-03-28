<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('section_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->unique(['section_id', 'locale']);
            $table->string('name');
            $table->longText('description');
            $table->string('head_of_department')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('section_translations');
    }
}
