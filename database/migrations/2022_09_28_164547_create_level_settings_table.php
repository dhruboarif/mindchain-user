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
        Schema::create('level_settings', function (Blueprint $table) {
            $table->id();
            $table->string('lvl_1');
            $table->string('lvl_2');
            $table->string('lvl_3');
            $table->string('lvl_4');
            $table->string('lvl_5');
            $table->string('status')->default(1);
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
        Schema::dropIfExists('level_settings');
    }
};
