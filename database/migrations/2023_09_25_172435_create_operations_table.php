<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->datetime('appointment');
            $table->decimal('price');
            $table->boolean('status_medicine')->default(0);
            $table->foreignId('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreignId('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
