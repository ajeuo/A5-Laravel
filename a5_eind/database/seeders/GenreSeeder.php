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
        Genre::create(['naam' => 'Electronic']); // id 4 etc
        Genre::create(['naam' => 'Hip-Hop']);
        Genre::create(['naam' => 'R&B']);
        Genre::create(['naam' => 'Jazz']);
        Genre::create(['naam' => 'Classical']);
        Genre::create(['naam' => 'Country']);
        Genre::create(['naam' => 'Reggae']);
        Genre::create(['naam' => 'Blues']);
        Genre::create(['naam' => 'Folk']);
        Genre::create(['naam' => 'Punk']);
        Genre::create(['naam' => 'Indie']);
        Genre::create(['naam' => 'Alternative']);
        Genre::create(['naam' => 'Dance']);
        Genre::create(['naam' => 'Soul']);
        Genre::create(['naam' => 'Funk']);
        Genre::create(['naam' => 'Vaporwave']);
    }
}
