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
        Schema::create('Image', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('url');
            $table->string('caption');
            $table->boolean('is_hidden')->default(false);
            $table->uuid('album_id')->nullable(false);
            $table->foreign('album_id')->references('id')->on('Album')->onDelete('cascade');
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
        Schema::dropIfExists('Image');
    }
};
