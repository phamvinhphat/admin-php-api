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
        Schema::create('Privilege', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->uuid('parent_n')->nullable();
            $table->primary('id');
            $table->foreign('parent_n')->references('id')->on('Privilege');
            $table->uuid('created_by');
            $table->uuid('modified');
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
        Schema::dropIfExists('Privilege');
    }
};
