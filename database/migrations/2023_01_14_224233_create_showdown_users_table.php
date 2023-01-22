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
        Schema::create('showdowns_users', function (Blueprint $table) {
            $table->id();
            $table->uuid('showdown_id');
            $table->uuid('user_id');
            $table->timestamps();

            $table->foreign('showdown_id')->references('id')->on('showdowns');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('showdown_users');
    }
};
