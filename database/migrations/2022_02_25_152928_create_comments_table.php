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
            $table->uuid('ID');
            $table->string('contents');
            $table->uuid('parent_n')->nullable();
            $table->primary('ID');
            $table->foreign('parent_n')->references('ID')->on('Comment');
            $table->uuid('album_id')->nullable(false);
            $table->foreign('album_id')->references('ID')->on('Album')->onDelete('cascade');
            $table->uuid('post_id')->nullable(false);
            $table->foreign('post_id')->references('ID')->on('Post')->onDelete('cascade');
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
        Schema::dropIfExists('Comment');
    }
};
