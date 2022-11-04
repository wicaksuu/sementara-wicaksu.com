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
        Schema::create('itemku_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id')->unique();
            $table->bigInteger('order_id');
            $table->bigInteger('product_id');
            $table->bigInteger('user_id');
            $table->string('product_name');
            $table->bigInteger('game_id');
            $table->bigInteger('price');
            $table->bigInteger('buyer_price');
            $table->bigInteger('quantity');
            $table->string('required_information');
            $table->string('seller_currency');
            $table->string('buyer_name');
            $table->integer('status');
            $table->bigInteger('order_value');
            $table->bigInteger('buyer_order_value');
            $table->string('game_name');
            $table->string('item_type_name');
            $table->string('order_number');
            $table->bigInteger('seller_income');
            $table->bigInteger('item_category');
            $table->text('resp_delivery');
            $table->bigInteger('modal')->nullable();
            $table->bigInteger('profit')->nullable();
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
        Schema::dropIfExists('itemku_orders');
    }
};
