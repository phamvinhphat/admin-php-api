<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->uuid('account_id')->unsigned();
            $table->uuid('conversation_id')->unsigned();
            $table->boolean('is_blocked')->default(false);
            $table->foreign('account_id')
                ->references('id')
                ->on('account')
                ->onDelete('cascade');
            $table->foreign('conversation_id')
                ->references('id')
                ->on('conversation')
                ->onDelete('cascade');
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
        //
        Schema::dropIfExists('member');
    }
};
