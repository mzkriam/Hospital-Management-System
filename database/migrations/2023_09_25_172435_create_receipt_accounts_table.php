<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptAccountsTable extends Migration
{
    public function up()
    {
        //سند قبض
        Schema::create('receipt_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('accountings_id')->nullable()->references('id')->on('accountings');
            $table->foreignId('admin_id')->references('id')->on('admins');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('receipt_accounts');
    }
}
