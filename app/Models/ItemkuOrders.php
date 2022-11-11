<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemkuOrders extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'product_id',
        'product_name',
        'game_id',
        'price',
        'buyer_price',
        'quantity',
        'required_information',
        'seller_currency',
        'buyer_name',
        'status',
        'order_value',
        'buyer_order_value',
        'game_name',
        'item_type_name',
        'seller_income',
        'item_category',
        'order_number',
        'user_id',
        'order_id',
        'resp_delivery',
        'modal',
        'profit',
        'player_id',
        'player_server',
        'player_nickname',
    ];
}
