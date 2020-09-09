<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'category-id', 'name', 'status', 'price', 'image', 'detail',
    ];
}
