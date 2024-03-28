<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('Services', function (Blueprint $table) {
            $table->id();
            $table->decimal("price", 8, 2);
            $table->boolean('status')->default(1);
            $table->foreignId('accountings_id')->nullable()->references('id')->on('accountings');
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreignId('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Services');
    }
}
