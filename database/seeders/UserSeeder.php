<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => fake()->userName(),
            'email' => 'info@admin.test',
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
            'is_admin' => 1
        ]);
    }
}
