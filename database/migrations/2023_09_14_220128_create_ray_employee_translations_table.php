<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRayEmployeeTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('ray_employee_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('ray_employee_id')->references('id')->on('ray_employees')->onDelete('cascade');
            $table->unique(['ray_employee_id', 'locale']);

            $table->string('name');
            $table->longText('description');
            $table->string('job_title')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('ray_employee_translations');
    }
}
