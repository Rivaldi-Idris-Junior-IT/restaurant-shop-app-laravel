<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'aldifarzum',
                'username'  => 'aldi',
                'email' => 'aldi@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('aldi1234')
            ],
            [
                'name' => 'admin',
                'username'  => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('admin1234'),
            ],
            [
                'name' => 'firmaandika',
                'username'  => 'andika',
                'email' => 'andika@gmail.com',
                'role' => 'staff',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'mayanatasha',
                'username'  => 'maya',
                'email' => 'maya@gmail.com',
                'role' => 'customer',
                'password' => bcrypt('password'),
            ]
        ];

        foreach($userData as $key => $val) {
            User::create($val);
        }
    }
}
