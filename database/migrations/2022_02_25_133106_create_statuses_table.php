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
        Schema::create('Status', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->uuid('parent_n')->nullable();
            $table->primary('id');
            $table->foreign('parent_n')->references('id')->on('Status');
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
        Schema::dropIfExists('Status');
    }
};
