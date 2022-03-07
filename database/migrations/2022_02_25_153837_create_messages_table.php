<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Message', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('msg');
            $table->uuid('reply_to');
            $table->primary('id');
            $table->foreign('reply_to')->references('id')->on('Message');
            $table->uuid('sender_id')->nullable(false);
            $table->foreign('sender_id')->references('id')->on('Account')->onDelete('cascade');
            $table->uuid('conversation_id')->nullable(false);
            $table->foreign('conversation_id')->references('id')->on('Conversation')->onDelete('cascade');
            $table->timestamps().date_default_timezone_get();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Message');
    }
};
