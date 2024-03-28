<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceGroupTable extends Migration
{
    public function up()
    {
        Schema::create('service_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId("service_id")->references("id")->on("Services")->onDelete("cascade");
            $table->foreignId("group_id")->references("id")->on("groups")->onDelete("cascade");
            $table->integer('quantity');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('service_group');
    }
}
