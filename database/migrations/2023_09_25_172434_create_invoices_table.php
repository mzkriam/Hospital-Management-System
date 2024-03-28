<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_type'); //single or group [1 => 'single', 2 => 'group']
            $table->date('invoice_date');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreignId('accountings_id')->nullable()->references('id')->on('accountings')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins')->onDelete('cascade');
            $table->foreignId('Group_id')->nullable()->references('id')->on('groups')->onDelete('cascade');
            $table->foreignId('Service_id')->nullable()->references('id')->on('Services')->onDelete('cascade');

            $table->double('price', 8, 2)->default(0);
            $table->double('discount_value', 8, 2)->default(0);
            $table->string('tax_rate');
            $table->string('tax_value');
            $table->double('total_with_tax', 8, 2)->default(0);
            $table->integer('type'); // نقدي او اجل
            $table->integer('invoice_status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
