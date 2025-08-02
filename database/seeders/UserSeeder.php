<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'aldi dambuk',
            'username' => 'aldi dambuk',
            'email' => 'reginaldus09876@gmail.com',
            'password' => Hash::make('password123')
        ]);
        User::factory(5)->create();
    }
}
