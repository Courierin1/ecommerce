<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unique_id = random_int(100000, 999999);
        User::create([
            'unique_id' => $unique_id,
            'user_name' => 'admin',
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('@@abcd23@@'),
            'role' => 1
        ]);
    }
}
