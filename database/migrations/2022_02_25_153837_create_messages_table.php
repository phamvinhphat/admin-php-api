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
            $table->uuid('ID');
            $table->string('msg');
            $table->uuid('reply_to');
            $table->primary('ID');
            $table->foreign('reply_to')->references('ID')->on('Message');
            $table->uuid('sender_id')->nullable(false);
            $table->foreign('sender_id')->references('ID')->on('Account')->onDelete('cascade');
            $table->uuid('conversation_id')->nullable(false);
            $table->foreign('conversation_id')->references('ID')->on('Conversation')->onDelete('cascade');
            $table->timestamps();
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
