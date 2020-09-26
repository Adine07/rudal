<?php

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::truncate();

        Order::create([
            'user_id' => '3',
            'customer_name' => 'Parjo',
            'total' => '50000',
        ]);

        Order::create([
            'user_id' => '3',
            'customer_name' => 'Muji',
            'total' => '43000',
        ]);

        Order::create([
            'user_id' => '3',
            'customer_name' => 'Siti',
            'total' => '71000',
        ]);
    }
}
