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
            'name' => 'Nasi',
            'stock' => '231',
        ]);

        Ingredient::create([
            'name' => 'Paha atas',
            'stock' => '100',
        ]);

        Ingredient::create([
            'name' => 'Dada atas',
            'stock' => '100',
        ]);

        Ingredient::create([
            'name' => 'Paha bawah',
            'stock' => '31',
        ]);
    }
}
