<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'ingredient_name', 'stock', 'format',
    ];

    public function Menu()
    {
        return $this->belongsToMany('App\Models\Menu');
    }

    // public function ingredient_menus()
    // {
    //     return $this->hasMany(IngredientMenu::class);
    // }
}
