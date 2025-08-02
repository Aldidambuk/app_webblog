<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Categoryseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'web developer',
            'slug' => 'web developer',
            'color'=> 'bg-red-200'
        ]);

        Category::create([
            'name' => 'artificial intelegence',
            'slug' => 'ai',
            'color'=> 'bg-green-200'
        ]);

        Category::create([
            'name' => 'crypto currency',
            'slug' => 'crypto currency',
            'color'=> 'bg-blue-200'
        ]);
    }
}
