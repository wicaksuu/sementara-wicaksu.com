<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariansItemku extends Model
{
    use HasFactory;
    protected $fillable = [
        'varian_id',
        'varian_name',
        'varian_slug',
        'varian_nominal_value',
        'game_id',
        'varian_is_active',
    ];
}
