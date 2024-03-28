<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('reception_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('reception_id')->references('id')->on('receptions')->onDelete('cascade');
            $table->unique(['locale', 'reception_id']);
            $table->string('name');
            $table->text('job_title')->nullable();
            $table->longText('description');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('reception_translations');
    }
}
