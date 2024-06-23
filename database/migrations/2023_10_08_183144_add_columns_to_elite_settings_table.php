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
        Schema::table('elite_settings', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('elite_settings', function (Blueprint $table) {
            $table->integer('lvl_1')->default(0);
            $table->integer('lvl_2')->default(0);
            $table->decimal('daily_bonus', 10, 2)->default(0.00);
            $table->integer('duration')->default(0);

        });
    }
};
