<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduksItemku extends Model
{
    use HasFactory;
    protected $fillable = [
        'game_id',
        'game_name',
        'game_slug',
        'game_is_active',
    ];
}
