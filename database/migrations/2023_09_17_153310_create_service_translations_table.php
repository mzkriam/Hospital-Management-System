<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('service_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->unique(['service_id', 'locale']);

            $table->string('name')->unique();
            $table->text('description');


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_translations');
    }
}
