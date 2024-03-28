<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabServiceTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('lab_service_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('lab_service_id')->references('id')->on('lab_services')->onDelete('cascade');
            $table->unique(['locale', 'lab_service_id']);

            $table->string('name')->nullable();
            $table->longText('description');
            $table->longText('description_employee')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lab_service_translations');
    }
}
