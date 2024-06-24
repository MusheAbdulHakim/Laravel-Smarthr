<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'firstname' => 'Mushe',
                'lastname' => 'Abdul-Hakim',
                'email' => 'superadmin@smarthr.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'type' => UserType::SUPERADMIN,
                'is_active' => 1,
                'created_at' => now(),
            ],
            [
                'firstname' => 'Smart',
                'lastname' => 'Employee',
                'email' => 'employee@smarthr.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'type' => UserType::EMPLOYEE,
                'is_active' => 1,
                'created_at' => now(),
            ],
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'client@smarthr.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'type' => UserType::CLIENT,
                'is_active' => 1,
                'created_at' => now(),
            ],
        ]);
    }
}
