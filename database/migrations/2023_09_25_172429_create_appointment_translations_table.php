<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('appointment_id')->references('id')->on("appointments")->onDelete('cascade');
            $table->unique(['locale', 'appointment_id']);

            $table->string('name')->nullable();
            $table->string('notes')->nullable();
            $table->string('Address')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('appointment_translations');
    }
}
