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
        Schema::create('document', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('document_code');
            $table->json('data');
            $table->boolean('is_workflow')->nullable(false);
            $table->boolean('is_auth')->nullable(false);
            $table->boolean('is_register')->nullable(false);
            $table->uuid('modified_by_id')->nullable();
            $table->uuid('created_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('account')->onDelete('cascade');
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
        Schema::dropIfExists('document');
    }
};
