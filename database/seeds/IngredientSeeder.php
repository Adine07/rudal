<?php

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingredient::truncate();

        Ingredient::create([
            'ingredient_name' => 'Nasi',
            'format' => 'porsi',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Ayam potongan paha atas',
            'format' => 'potong',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Ayam potongan dada atas',
            'format' => 'potong',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Ayam potongan paha bawah',
            'format' => 'potong',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Cabai',
            'format' => 'buah',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Bawang merah',
            'format' => 'buah',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Bawang putih',
            'format' => 'buag',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Garam',
            'format' => 'gram',
        ]);
    }
}
