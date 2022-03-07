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
        Schema::create('Account', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username');
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('id_card')->unique();
            $table->string('avatar')->nullable();;
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->boolean('is_verify')->default(false);
            $table->uuid('privilege_id')->nullable(false);
            $table->foreign('privilege_id')->references('id')->on('Privilege')->onDelete('cascade');
            $table->uuid('modified');
            $table->string('api_token', 80)->after('password')
                ->unique()
                ->nullable()
                ->default(null);
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
        Schema::dropIfExists('Account');
    }
};
