<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Gabx', 
            'email' => 'gabrvinicius3456@gmail.com', 
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
    }
}
