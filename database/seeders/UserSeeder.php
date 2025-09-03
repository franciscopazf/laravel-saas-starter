<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usuarios\CentralUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // CentralUser::create([
        //     'name' => "Jose Paz",
        //     'email' => "josepaz3123@gmail.com",
        //     'email_verified_at' => null,
        //     'workos_id' => "user_01JTM3DAWXJNQR746H4R6H8V79",
        //     'remember_token' => null,
        //     'avatar' => "https://workoscdn.com/images/v1/Kj1-ziB2jvXARSqT9FvMQ6y1l-WgcAu8Zu0pGC0EBSc",
        // ]);
    }
}
