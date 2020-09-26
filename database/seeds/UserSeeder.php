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
            'role' => 'admin',
            'email' => 'admin@admin',
            'password' => Hash::make('secret'),
        ]);

        User::create([
            'name' => 'Operator',
            'role' => 'operator',
            'email' => 'operator@operator',
            'password' => Hash::make('secret'),
        ]);

        User::create([
            'name' => 'Kasir',
            'role' => 'kasir',
            'email' => 'kasir@kasir',
            'password' => Hash::make('secret'),
        ]);
    }
}
