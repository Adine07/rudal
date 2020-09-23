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
            'stock' => '231',
            'format' => 'porsi',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Ayam potongan paha atas',
            'stock' => '100',
            'format' => 'potong',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Ayam potongan dada atas',
            'stock' => '100',
            'format' => 'potong',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Ayam potongan paha bawah',
            'stock' => '31',
            'format' => 'potong',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Cabai',
            'stock' => '800',
            'format' => 'buah',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Bawang merah',
            'stock' => '500',
            'format' => 'buah',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Bawang putih',
            'stock' => '500',
            'format' => 'buag',
        ]);

        Ingredient::create([
            'ingredient_name' => 'Garam',
            'stock' => '3000',
            'format' => 'gram',
        ]);
    }
}
