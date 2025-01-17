<?php

namespace Database\Seeders;

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
        $user = new User();
        $user-> name = 'admin';
        $user-> email = "admin@example.com";
        $user-> password = Hash::make("password");
        $user-> department_id = 1;
        $user -> save();
        $user1 = new User();
        $user1-> name = "Gabriel";
        $user1-> email = "gabri@example.com";
        $user1 -> password = Hash::make("password");
        $user1-> department_id = 2;
        $user1 -> save();
    }
}
