<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('medicine_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->unique(['locale', 'medicine_id']);

            $table->string('name')->unique();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicine_translations');
    }
}
