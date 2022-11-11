<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreVarian extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'varian_name',
        'base_varian_id',
        'price'
    ];
}
