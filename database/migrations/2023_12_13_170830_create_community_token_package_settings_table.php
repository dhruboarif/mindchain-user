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
        Schema::create('community_token_package_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('base_mind_id');
            $table->foreign('base_mind_id')->references('id')->on('base_minds');
            $table->string('amount');
            $table->decimal('daily_bonus', 8, 2);
            $table->decimal('sponsor_bonus', 8, 2);
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
        Schema::dropIfExists('community_token_package_settings');
    }
};
