<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_name',
        'store_url',
        'store_username',
        'store_password',
        'store_header',
        'store_auth',
        'store_data',
        'store_metod',
    ];
}
