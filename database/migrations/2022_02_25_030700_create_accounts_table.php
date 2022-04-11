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
            $table->string('username')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob')->nullable();
            $table->string('id_card')->unique();
            $table->string('avatar')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->boolean('is_verify')->default(false);
            $table->string('saved_posts')->nullable();
            $table->string('recently_viewed_posts')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->uuid('role_id')->default('766be67a-6520-4968-85ea-e9e07daf4e53');
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
