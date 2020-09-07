<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        Category::create([
            'name' => 'Makanan',
        ]);

        Category::create([
            'name' => 'Makanan Ringan',
        ]);

        Category::create([
            'name' => 'Minuman',
        ]);

        Category::create([
            'name' => 'Minuman Ringan',
        ]);
    }
}
