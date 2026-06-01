<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BandCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_band(): void {
        $user = \App\Models\User::factory()->create();
        $genre = \App\Models\Genre::create(['naam' => 'Rock']);

        $response = $this->actingAs($user)->post('/bands', [
            'naam' => 'Test Band',
            'beschrijving' => 'Test beschrijving',
            'biografie' => 'Test biografie',
            'genre_id' => $genre->id,
            'achtergrondkleur' => '#ffffff',
            'tekstkleur' => '#000000',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('bands', ['naam' => 'Test Band']);
    }

    public function test_authenticated_user_can_edit_band(): void {
        $user = \App\Models\User::factory()->create();
        $genre = \App\Models\Genre::create(['naam' => 'Rock']);
        $band = \App\Models\Band::create([
            'naam' => 'Test Band',
            'genre_id' => $genre->id,
            'beschrijving' => 'Test',
            'biografie' => 'Test',
            'achtergrondkleur' => '#ffffff',
            'tekstkleur' => '#000000',
        ]);
        $user->bands()->attach($band->id);

        $response = $this->actingAs($user)->put('/bands/' . $band->id, [
            'naam' => 'Gewijzigde Band',
            'genre_id' => $genre->id,
            'beschrijving' => 'Test',
            'biografie' => 'Test',
            'achtergrondkleur' => '#ffffff',
            'tekstkleur' => '#000000',
        ]);

        $response->assertRedirect('/bands/' . $band->id);
        $this->assertDatabaseHas('bands', ['naam' => 'Gewijzigde Band']);
    }

    public function test_guest_cannot_create_band(): void 
    { 
        $response = $this->post('/bands', [
            'naam' => 'Test Band',
        ]);

        $response->assertRedirect('/login');
    }
}
