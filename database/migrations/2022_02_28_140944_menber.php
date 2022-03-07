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
        Schema::create('Member', function (Blueprint $table) {
            $table->uuid('account_id')->unsigned();
            $table->uuid('thead_id')->unsigned();
            $table->boolean('is_blocked')->default(false);
            $table->foreign('account_id')
                ->references('id')
                ->on('Account')
                ->onDelete('cascade');
            $table->foreign('thead_id')
                ->references('id')
                ->on('Conversation')
                ->onDelete('cascade');
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
    }
};
