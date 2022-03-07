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
            $table->uuid('id')->primary();
            $table->string('url');
            $table->uuid('caption');
            $table->uuid('message_id')->nullable(false);
            $table->foreign('message_id')->references('id')->on('Message')->onDelete('cascade');
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
        Schema::dropIfExists('Attachment');
    }
};
