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
            'name' => 'Budi',
            'email' => 'home1@email.com',
            'is_admin' => RoleEnum::USER,
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
        User::query()->create([
            'name' => 'Rini',
            'email' => 'home2@email.com',
            'is_admin' => RoleEnum::USER,
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
         User::query()->create([
            'name' => 'Siti',
            'email' => 'home3@email.com',
            'is_admin' => RoleEnum::USER,
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
         User::query()->create([
            'name' => 'Ahmad',
            'email' => 'home4@email.com',
            'is_admin' => RoleEnum::USER,
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
         User::query()->create([
            'name' => 'Dewi',
            'email' => 'home5@email.com',
            'is_admin' => RoleEnum::USER,
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
         User::query()->create([
            'name' => 'Joko',
            'email' => 'home6@email.com',
            'is_admin' => RoleEnum::USER,
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
         User::query()->create([
            'name' => 'Nita',
            'email' => 'home7@email.com',
            'is_admin' => RoleEnum::USER,
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
         User::query()->create([
            'name' => 'Agus',
            'email' => 'home8@email.com',
            'is_admin' => RoleEnum::USER,
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
         User::query()->create([
            'name' => 'Dian',
            'email' => 'home9@email.com',
            'is_admin' => RoleEnum::USER,
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);
         User::query()->create([
            'name' => 'Irfan',
            'email' => 'home10@email.com',
            'is_admin' => RoleEnum::USER,
            'password' => bcrypt('password'),
            'created_by' => 1
        ]);

    }
}
