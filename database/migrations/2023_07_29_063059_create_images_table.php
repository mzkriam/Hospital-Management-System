<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->integer('imageable_id');
            $table->string('imageable_type');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
