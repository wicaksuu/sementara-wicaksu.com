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
        Schema::create('produks_itemkus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('game_id');
            $table->string('game_name');
            $table->string('game_slug');
            $table->boolean('game_is_active');
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
        Schema::dropIfExists('produks_itemkus');
    }
};
