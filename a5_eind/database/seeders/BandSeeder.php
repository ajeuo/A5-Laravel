<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Band;


class BandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Band::create(['naam' => 'Solence', 'genre_id' => 1]);
        Band::create(['naam' => 'Sleep Token', 'genre_id' => 2]);
        Band::create(['naam' => 'Wind Walkers', 'genre_id' => 2]);
        Band::create(['naam' => 'desert sand feels warm at night', 'genre_id' => 4]);
        Band::create(['naam' => 'DON BROCO', 'genre_id' => 1]);
        Band::create(['naam' => 'NF', 'genre_id' => 3]);
        Band::create(['naam' => 'STARSET', 'genre_id' => 1]);
        Band::create(['naam' => 'Thornhill', 'genre_id' => 2]);

        $user = \App\Models\User::first();
        $user->bands()->attach([1, 2, 3]);
    }
}
