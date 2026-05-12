<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create(['naam' => 'Rock']); // dit id is dan 1
        Genre::create(['naam' => 'Pop']); // id 2     
        Genre::create(['naam' => 'Metal']); // id 3
        Genre::create(['naam' => 'Electronic']); // id 4
    }
}
