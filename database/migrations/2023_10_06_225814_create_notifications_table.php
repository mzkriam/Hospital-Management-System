<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->boolean('reader_status')->default(false);
            $table->enum('section', ['ray', 'laboratory', 'pharmacy', 'treatment', 'operation'])->nullable();
            $table->integer('user_id')->nullable();
            $table->foreignId('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreignId('ray_service_id')->nullable()->references('id')->on('ray_services')->onDelete('cascade');
            $table->foreignId('lab_service_id')->nullable()->references('id')->on('lab_services')->onDelete('cascade');
            $table->foreignId('treatment_id')->nullable()->references('id')->on('treatments')->onDelete('cascade');
            $table->foreignId('operation_id')->nullable()->references('id')->on('operations')->onDelete('cascade');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->text('message');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
