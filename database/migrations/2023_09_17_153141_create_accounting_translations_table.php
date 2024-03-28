<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('accounting_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->foreignId('accounting_id')->references('id')->on('accountings')->onDelete('cascade');
            $table->unique(['accounting_id', 'locale']);

            $table->string('name');
            $table->longText('description');
            $table->string('job_title')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('accounting_translations');
    }
}
