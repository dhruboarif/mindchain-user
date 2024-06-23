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
        Schema::create('purcahse_community_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token_name');
            $table->integer('user_id');
            $table->integer('token_amount');
            $table->integer('token_base_price');
            $table->integer('bonus_duration');
            $table->integer('total_price');
            $table->float('daily_bonus');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('purcahse_community_tokens');
    }
};
