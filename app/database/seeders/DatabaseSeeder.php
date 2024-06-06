<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Customer::create([
            'name'=>'Kasimu Yusuph',
            'email' => 'kasimuyusuph@gmail.com',
            'phone_number' => '0654129012',
            'address' => 'Mbeya,Iyunga',
            'username' => 'kasimu@123',
            'password' => '123456789.',
        ]);


        User::create([
            'name' => 'Mosses Mosses',
            'username' => 'mosses608',
            'password' => '123456789',
            'role'=> 'Admin',
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
