<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->string('sender_email')->comment('المرسل');
            $table->string('receiver_email')->comment('المستقبل');
            $table->timestamp('last_time_message')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
