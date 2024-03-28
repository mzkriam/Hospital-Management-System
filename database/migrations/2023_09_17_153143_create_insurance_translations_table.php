<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('insurance_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId("insurance_id")->references("id")->on("insurances")->onDelete("cascade");
            $table->unique(["insurance_id", "locale"]);

            $table->string("name")->unique();
            $table->string("notes")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('insurance_translations');
    }
}
