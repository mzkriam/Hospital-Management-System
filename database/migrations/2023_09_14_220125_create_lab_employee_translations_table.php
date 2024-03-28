<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabEmployeeTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('lab_employee_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('lab_employee_id')->references('id')->on('lab_employees')->onDelete('cascade');
            $table->unique(['lab_employee_id', 'locale']);

            $table->string('name');
            $table->text('job_title')->nullable();
            $table->longText('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lab_employee_translations');
    }
}
