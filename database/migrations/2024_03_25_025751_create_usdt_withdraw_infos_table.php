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
        Schema::create('usdt_withdraw_infos', function (Blueprint $table) {
            $table->id();
    
            $table->string('withdraw_commission');
            $table->string('withdraw_limit_max');
            $table->string('withdraw_limit_min');
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
        Schema::dropIfExists('usdt_withdraw_infos');
    }
};
