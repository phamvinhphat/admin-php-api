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
        Schema::create('workflow', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('status_id')->nullable(false);
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->uuid('modified_by_id')->nullable();
            $table->uuid('created_by_id')->nullable(false);
            $table->foreign('created_by_id')->references('id')->on('account')->onDelete('cascade');
            $table->uuid('document_id')->nullable(false);
            $table->foreign('document_id')->references('id')->on('document')->onDelete('cascade');
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
        Schema::dropIfExists('workflow');
    }
};
