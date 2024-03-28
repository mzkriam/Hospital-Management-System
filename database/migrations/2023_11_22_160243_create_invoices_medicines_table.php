<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreignId('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('invoices_medicines');
    }
}
