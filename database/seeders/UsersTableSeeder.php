<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'name' => 'testユーザ１',
            'email' => 'test@test.com',
            'password' => Hash::make('password'),
        ]);

        User::query()->create([
            'name' => 'testユーザ２',
            'email' => 'test2@test.com',
            'password' => Hash::make('password'),
        ]);

        User::query()->create([
            'name' => 'testユーザ３',
            'email' => 'test3@test.com',
            'password' => Hash::make('guest'),
        ]);
    }
}
