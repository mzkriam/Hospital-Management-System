<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhaEmployeeTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('pha_employee_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('pha_employee_id')->references('id')->on('pha_employees')->onDelete('cascade');
            $table->unique(['locale', 'pha_employee_id']);

            $table->string('name');
            $table->longText('description');
            $table->string('job_title')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pha_employee_translations');
    }
}
