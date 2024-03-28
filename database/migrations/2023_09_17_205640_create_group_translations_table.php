<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('group_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('group_id')->references("id")->on('groups')->onDelete("cascade");
            $table->unique(["group_id", "locale"]);

            $table->string("name")->unique();
            $table->string("notes")->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('group_translation');
    }
}
