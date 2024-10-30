<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Anonymous',
                'username' => 'Anonymous',
                'email' => 'anonymous@yahoo.com',
                'password' => Hash::make('0')
            ],
            [
                'name' => 'TruePremium',
                'username' => 'TruePremium',
                'email' => 'Premium@yahoo.com',
                'password' => Hash::make('0'),
                'hasPremium' => '1'
            ],
            [
                'name' => 'FalsePremium',
                'username' => 'FalsePremium',
                'email' => 'noPremium@yahoo.com',
                'password' => Hash::make('0')
            ]
        ];

        foreach ($users as $user) {
            User::create($user);       
        }
        User::factory()->count(20)->create(); 
    }
}
