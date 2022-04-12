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
        Schema::create('post', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('contents');
            $table->double('longitude');
            $table->double('latitude');
            $table->bigInteger('price');
            $table->float('floor_area');
            $table->string('furniture_status');
            $table->bigInteger('views')->default(0);
            $table->uuid('document_id')->nullable(false);
            $table->foreign('document_id')->references('id')->on('document')->onDelete('cascade');
            $table->uuid('modified_by_id')->nullable();
            $table->uuid('created_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('account')->onDelete('cascade');
            $table->uuid('album_id')->nullable();
            $table->foreign('album_id')->references('id')->on('album')->onDelete('cascade');
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
        Schema::dropIfExists('post');
    }
};
