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
        Schema::create('account', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username');
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('id_card');
            $table->string('avatar')->nullable();;
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->boolean('is_verify')->default(false);
            $table->string('saved_posts')->nullable();
            $table->string('recently_viewed_posts')->nullable();
            $table->uuid('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
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
        Schema::dropIfExists('account');
    }
};
