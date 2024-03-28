<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbulanceTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('ambulance_translations', function (Blueprint $table) {
            $table->id();
            $table->string("locale")->index();
            $table->foreignId("ambulance_id")->references("id")->on("ambulances")->onDelete("cascade");
            $table->unique(["ambulance_id", "locale"]);

            $table->string("driver_name");
            $table->string("notes");
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('ambulance_translations');
    }
}
