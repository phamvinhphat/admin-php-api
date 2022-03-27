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
        Schema::create('pending_post', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->double('longitude');
            $table->double('latitude');
            $table->string('contents');
            $table->bigInteger('price');
            $table->string('floor_area');
            $table->string('address');
            $table->integer('views');
            $table->string('furniture_status');
            $table->uuid('album_id')->nullable(false);
            $table->foreign('album_id')->references('id')->on('album')->onDelete('cascade');
            $table->uuid('modified_by_id')->nullable();
            $table->uuid('created_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('account')->onDelete('cascade');
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
        Schema::dropIfExists('pending_post');
    }
};
