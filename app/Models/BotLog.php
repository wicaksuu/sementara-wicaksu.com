<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'store_varian_id',
        'store_id',
        'store_data',
        'response',
    ];
}
