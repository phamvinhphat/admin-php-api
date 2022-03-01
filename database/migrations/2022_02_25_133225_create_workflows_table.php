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
        Schema::create('Workflow', function (Blueprint $table) {
            $table->uuid('ID')->primary();
            $table->uuid('status_id')->nullable(false);
            $table->foreign('status_id')->references('ID')->on('Status')->onDelete('cascade');
            $table->uuid('created_by')->nullable(false);
            $table->foreign('created_by')->references('ID')->on('Account')->onDelete('cascade');
            $table->uuid('pending_post_id')->nullable(false);
            $table->foreign('pending_post_id')->references('ID')->on('PendingPost')->onDelete('cascade');
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
        Schema::dropIfExists('Workflow');
    }
};
