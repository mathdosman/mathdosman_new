<?php

namespace Database\Seeders;

use App\Models\User;
use App\UserStatus;
use App\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'mathdosman@gmail.com',
            'username' =>'admin',
            'password' => Hash::make('007007'),
            'type'=>UserType::SuperAdmin,
            'status'=>UserStatus::Active,
        ]);
    }
}