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
        Schema::create('PendingPost', function (Blueprint $table) {
            $table->uuid('ID')->primary();
            $table->double('longitude');
            $table->double('latitude');
            $table->string('contents');
            $table->bigInteger('price');
            $table->string('floor_area');
            $table->string('address');
            $table->string('furniture_status');
            $table->uuid('album_id')->nullable(false);
            $table->foreign('album_id')->references('ID')->on('Album')->onDelete('cascade');
            $table->uuid('create_by')->nullable(false);
            $table->foreign('create_by')->references('ID')->on('Account')->onDelete('cascade');
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
        Schema::dropIfExists('PendingPost');
    }
};
