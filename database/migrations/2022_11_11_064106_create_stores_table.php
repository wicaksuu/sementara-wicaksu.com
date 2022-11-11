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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('store_metod')->nullable();
            $table->string('store_name')->nullable();
            $table->string('store_url')->nullable();
            $table->string('store_username')->nullable();
            $table->string('store_password')->nullable();
            $table->text('store_data')->nullable();
            $table->text('store_header')->nullable();
            $table->text('store_auth')->nullable();
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
        Schema::dropIfExists('stores');
    }
};
