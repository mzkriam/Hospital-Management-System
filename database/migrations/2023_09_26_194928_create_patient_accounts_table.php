<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('patient_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('invoice_id')->nullable()->references('id')->on('invoices')->onDelete('cascade');
            $table->foreignId('ray_id')->nullable()->references('id')->on('ray_services')->onDelete('cascade');
            $table->foreignId('lab_id')->nullable()->references('id')->on('lab_services')->onDelete('cascade');
            $table->foreignId('operation_id')->nullable()->references('id')->on('operations')->onDelete('cascade');
            $table->foreignId('Payment_id')->nullable()->references('id')->on('payment_accounts')->onDelete('cascade');
            $table->foreignId('receipt_id')->nullable()->references('id')->on('receipt_accounts')->onDelete('cascade');
            $table->decimal('Debit', 8, 2)->nullable();    // المبلغ المتبقي على المريض للمشفى  (الفاتورة الاجل)
            $table->decimal('credit', 8, 2)->nullable();  //  (سند قبض)      المبلغ الذي دفعه المريض للمشفى
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('patient_accounts');
    }
}
