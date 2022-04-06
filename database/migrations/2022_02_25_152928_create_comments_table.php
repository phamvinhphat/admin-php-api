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
        Schema::create('comment', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('contents');
            $table->uuid('parent_n')->nullable();
            $table->primary('id');
            $table->foreign('parent_n')->references('id')->on('comment');
            $table->uuid('album_id')->nullable(false);
            $table->foreign('album_id')->references('id')->on('album')->onDelete('cascade');
            $table->uuid('post_id')->nullable(false);
            $table->foreign('post_id')->references('id')->on('post')->onDelete('cascade');
            $table->uuid('modified_by_id')->nullable();
            $table->uuid('created_by_id')->nullable();
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
        Schema::dropIfExists('comment');
    }
};
