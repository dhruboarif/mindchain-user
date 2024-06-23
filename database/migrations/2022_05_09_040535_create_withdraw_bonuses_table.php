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
        Schema::create('withdraw_bonuses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('wallet_method_id');
            $table->string('wallet_no');
            $table->string('amount');
            $table->string('payable');
             $table->enum('status',['pending','approve','rejected'])->default('pending');
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
        Schema::dropIfExists('withdraw_bonuses');
    }
};
