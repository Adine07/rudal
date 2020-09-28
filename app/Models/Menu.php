<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'category_id', 'name', 'stock', 'price', 'image', 'detail', 'sold',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function ingredient()
    {
        return $this->belongsToMany('App\Models\Ingredient');
    }

    public function ingre_menus()
    {
        return $this->hasMany(IngredientMenu::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
