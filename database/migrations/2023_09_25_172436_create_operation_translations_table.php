<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('operation_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('operation_id')->references('id')->on('operations')->onDelete('cascade');
            $table->unique(['locale', 'operation_id']);

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
        Schema::dropIfExists('operation_translations');
    }
}
