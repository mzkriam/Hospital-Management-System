<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{

    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accountings_id')->nullable()->references('id')->on('accountings')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins')->onDelete('cascade');
            $table->decimal("Total_before_discount", 8, 2);
            $table->decimal("discount_value", 8, 2);
            $table->decimal("Total_after_discount", 8, 2);
            $table->decimal("tax_rate", 8, 2);
            $table->decimal("Total_with_tax", 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
