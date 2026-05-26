<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BandTest extends TestCase
{
    use RefreshDatabase;

    // Test als de homepagina goed laadt
    public function test_homepage_loads(): void {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // Kijkt als bands gezien worden in de zoekbalk
    public function test_search_returns_bands(): void {
        $genre = \App\Models\Genre::create(['naam' => 'Rock']);
        $band = \App\Models\Band::create([
            'naam' => 'Solence',
            'genre_id' => $genre->id,
        ]);

        $response = $this->get('/?search=Solence');
        $response->assertSee('Solence');
    }

    // test als je naar band pagina kan
    public function test_band_page_loads(): void {
        $genre = \App\Models\Genre::create(['naam' => 'Rock']);
        $band = \App\Models\Band::create([
            'naam' => 'Solence',
            'genre_id' => $genre->id,
        ]);

        $response = $this->get('/bands/' . $band->id);
        $response->assertStatus(200);
        $response->assertSee('Solence');
    }

    // test als gebruiker het dashboard in kan (default is niet)
    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

}