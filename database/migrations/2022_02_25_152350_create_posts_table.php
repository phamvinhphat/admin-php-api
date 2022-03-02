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
        Schema::create('Post', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('contents');
            $table->double('longitude');
            $table->double('latitude');
            $table->bigInteger('price');
            $table->string('floor_area');
            $table->string('address');
            $table->string('furniture_status');
            $table->uuid('created_by')->nullable(false);
            $table->foreign('created_by')->references('id')->on('Account')->onDelete('cascade');
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
        Schema::dropIfExists('Post');
    }
};
