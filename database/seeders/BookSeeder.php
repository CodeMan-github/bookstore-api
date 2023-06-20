<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert(
            [
                'title' => Str::random(10),
                'description' => Str::random(50),
                'publisher' => Str::random(10),
                'author' => Str::random(10),
                'price' => 10,
            ],
            [
                'title' => Str::random(10),
                'description' => Str::random(50),
                'publisher' => Str::random(10),
                'author' => Str::random(10),
                'price' => 15,
            ],
        );
    }
}
