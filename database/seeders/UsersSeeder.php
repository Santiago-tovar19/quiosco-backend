<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([

        [
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("12345678"),
            "admin" => 1
        ],
        [
            "name" => "consumidor",
            "email" => "consumidor@gmail.com",
            "password" => bcrypt("12345678"),
            "admin" => 0
        ],

     ]

    );


    }
}
