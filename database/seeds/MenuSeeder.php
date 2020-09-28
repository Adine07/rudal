<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::truncate();

        Menu::create([
            'category_id' => '1',
            'name' => 'Ayam Goreng Paha Atas',
            'stock' => '121',
            'price' => '15000',
            'image' => 'ayam.jpeg',
            'detail' => 'lorem ipsum dolor sit, amet?',
        ]);

        Menu::create([
            'category_id' => '2',
            'name' => 'Ayam Goreng Dada Atas',
            'stock' => '122',
            'price' => '15000',
            'image' => 'ayam.jpeg',
            'detail' => 'lorem ipsum dolor sit, amet?',
        ]);

        Menu::create([
            'category_id' => '3',
            'name' => 'Ayam Goreng Paha bawah',
            'stock' => '120',
            'price' => '10000',
            'image' => 'ayam.jpeg',
            'detail' => 'lorem ipsum dolor sit, amet?',
        ]);
    }
}
