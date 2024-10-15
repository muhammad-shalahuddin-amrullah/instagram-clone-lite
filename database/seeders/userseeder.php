<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userseeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'      => 'Nama User Kesatu',
                'email'     => 'me@gmail.com',
                'password'  => '12345678',
                'username'  => 'user_01',
                'bio'       => null,
                'profile_picture' => 'images/default_profile_picture.jpg',
            ],
            [
                'name'      => 'Nama User Kedua',
                'email'     => 'user2@gmail.com',
                'password'  => '12345678',
                'username'  => 'user_02',
                'bio'       => 'Bio user kedua',
                'profile_picture' => 'images/default_profile_picture2.jpg',
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name'      => $user['name'],
                'email'     => $user['email'],
                'password'  => Hash::make($user['password']),
                'username'  => $user['username'],
                'bio'       => $user['bio'],
                'profile_picture' => $user['profile_picture'],
            ]);
        }
    }
}
