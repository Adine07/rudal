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
            'name' => 'Paha Atas',
            'status' => '1',
            'price' => '15000',
            'image' => 'none-belum ada',
            'detail' => 'lorem ipsum dolor sit, amet?',
        ]);

        Menu::create([
            'category_id' => '2',
            'name' => 'dada Atas',
            'status' => '1',
            'price' => '15000',
            'image' => 'none-belum ada',
            'detail' => 'lorem ipsum dolor sit, amet?',
        ]);

        Menu::create([
            'category_id' => '3',
            'name' => 'Paha bawah',
            'status' => '0',
            'price' => '10000',
            'image' => 'none-belum ada',
            'detail' => 'lorem ipsum dolor sit, amet?',
        ]);
    }
}
