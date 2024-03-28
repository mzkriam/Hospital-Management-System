<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accountings_id')->nullable()->references('id')->on('accountings')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins')->onDelete('cascade');
            $table->string("contact_number")->unique();
            $table->string("insurance_code")->unique();
            $table->string("discount_percentage");
            $table->integer("company_rate");
            $table->boolean("status");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('insurance');
    }
}
