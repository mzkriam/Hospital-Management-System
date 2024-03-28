<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRayServicesTable extends Migration
{
    public function up()
    {
        Schema::create('ray_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreignId('ray_employ_id')->nullable()->references('id')->on('ray_employees')->onDelete('cascade');
            $table->decimal('price', 8, 2)->nullable();
            $table->string('code')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('case')->default(0);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('ray_services');
    }
}
