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
        Schema::create('varians_itemkus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('varian_id');
            $table->string('varian_name');
            $table->string('varian_slug');
            $table->string('varian_nominal_value');
            $table->bigInteger('game_id');
            $table->boolean('varian_is_active');
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
        Schema::dropIfExists('varians_itemkus');
    }
};
