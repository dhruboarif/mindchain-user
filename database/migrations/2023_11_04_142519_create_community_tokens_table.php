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
        Schema::create('community_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('token_name');
            $table->string('contract_address');
            $table->string('blockchain');
            $table->string('total_supply');
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
        Schema::dropIfExists('community_tokens');
    }
};
