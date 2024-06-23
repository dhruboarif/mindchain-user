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
        Schema::create('perry_minds', function (Blueprint $table) {
            $table->id();
            $table->integer('title');
            $table->integer('total_token_issues');
            $table->integer('token_base_price');
            $table->integer('duration');
            $table->float('daily_bonus');
            $table->float('sponsor_bonus');
            $table->float('lvl1_bonus');
            $table->float('lvl2_bonus');
            $table->float('lvl3_bonus');
            $table->float('lvl4_bonus');
            $table->float('lvl5_bonus');
            $table->date('start_date')->nullable()->collation('utf8_general_ci');
            $table->date('end_date')->nullable()->collation('utf8_general_ci');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('perry_minds');
    }
};
