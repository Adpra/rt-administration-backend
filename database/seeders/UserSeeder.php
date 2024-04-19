<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'is_admin' => RoleEnum::ADMIN,
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);

        User::query()->create([
            'name' => 'User',
            'email' => 'user@email.com',
            'is_admin' => RoleEnum::USER,
            'password' => bcrypt('password'),
            'created_by' => 2
        ]);

    }
}
