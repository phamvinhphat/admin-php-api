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
        Schema::create('Comment', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('contents');
            $table->uuid('parent_n')->nullable();
            $table->primary('id');
            $table->foreign('parent_n')->references('id')->on('Comment');
            $table->uuid('album_id')->nullable(false);
            $table->foreign('album_id')->references('id')->on('Album')->onDelete('cascade');
            $table->uuid('post_id')->nullable(false);
            $table->foreign('post_id')->references('id')->on('Post')->onDelete('cascade');
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
        Schema::dropIfExists('Comment');
    }
};
