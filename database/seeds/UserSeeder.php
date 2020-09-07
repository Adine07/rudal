<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => Hash::make('secret'),
        ]);

        User::create([
            'name' => 'Operator',
            'email' => 'operator@operator',
            'password' => Hash::make('secret'),
        ]);

        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@kasir',
            'password' => Hash::make('secret'),
        ]);
    }
}
