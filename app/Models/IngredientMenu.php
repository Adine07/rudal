<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientMenu extends Model
{
    protected $fillable = [
        'menu_id', 'ingredient_id', 'qty',
    ];

    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
