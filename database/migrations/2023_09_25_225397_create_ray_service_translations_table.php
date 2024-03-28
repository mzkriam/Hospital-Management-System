<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRayServiceTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('ray_service_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('ray_service_id')->references('id')->on('ray_services')->onDelete('cascade');
            $table->unique(['locale', 'ray_service_id']);

            $table->string('name')->nullable();
            $table->longText('description');
            $table->longText('description_employee')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('ray_service_translations');
    }
}
