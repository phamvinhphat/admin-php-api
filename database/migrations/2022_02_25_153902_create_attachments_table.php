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
        Schema::create('Attachment', function (Blueprint $table) {
            $table->uuid('ID')->primary();
            $table->string('url');
            $table->uuid('caption');
            $table->uuid('message_id')->nullable(false);
            $table->foreign('message_id')->references('ID')->on('Message')->onDelete('cascade');
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
        Schema::dropIfExists('Attachment');
    }
};
