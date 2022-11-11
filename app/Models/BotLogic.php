<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotLogic extends Model
{
    use HasFactory;
    protected $fillable = [
        'varian_id',
        'game_id',
        'store_varian_id'
    ];
}
