<?php

namespace App\Http\Controllers;
use App\Models\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    public function index(Request $request) {

        $searchReq = $request->input('search');

        $bands = collect();

        if ($request->filled('search')) {
            $bands = Band::where('naam', 'like', '%' . $searchReq . '%')->get();
        } else {
            $bands = Band::all();
        }

        return view('home', ['bands' => $bands]);
    }

    public function show($id) {
        $band = Band::findOrFail($id);
        return view('band', ['band' => $band]);
    }

    public function edit($id) {
        $band = Band::findOrFail($id);
        $genres = \App\Models\Genre::all();
        return view('band-edit', ['band' => $band, 'genres' => $genres]);
    }

    // edit / update
    public function update(Request $request, $id) {
        $request->validate([
            'foto' => 'nullable|image|max:8192',
        ]);

        // update band informatie in edit scherm
        $band = Band::findOrFail($id);
        $band->update([
            'naam' => $request->input('naam'),
            'beschrijving' => $request->input('beschrijving'),
            'biografie' => $request->input('biografie'),
            'genre_id' => $request->input('genre_id'),
            'achtergrondkleur' => $request->input('achtergrondkleur'),
            'tekstkleur' => $request->input('tekstkleur'),
        ]);

        // Sla fotos op
        if ($request->hasFile('foto')) {
            $pad = $request->file('foto')->store('fotos', 'public');
            $band->foto = $pad;
            $band->save();
        }

        // Foto verwijderen
        if ($request->input('foto_verwijderen') == '1') {
            Storage::delete($band->foto);
            $band->foto = null;
            $band->save();
        }

        // Videos verwijderen als url leeg is
        $band->videos()->delete();
        foreach ($request->input('videos', []) as $url) {
            if (!empty($url)) {
                $band->videos()->create(['url' => $url]);
            }
        }

        if ($request->filled('gebruiker_toevoegen')) {
            $gebruiker = \App\Models\User::where('email', $request->input('gebruiker_toevoegen'))->first();
            if ($gebruiker) {
                $band->users()->syncWithoutDetaching([$gebruiker->id]);
            }
        }

        return redirect('/bands/' . $id);
    }

    public function dashboard() {
        $bands = auth()->user()->bands;
        return view('dashboard', ['bands' => $bands]);
    }

    public function create() {
        $genres = \App\Models\Genre::all();
        return view('band-create', ['genres' => $genres]);
    }

    public function store(Request $request) {
        $request->validate([
            'foto' => 'nullable|image|max:8192',
        ]);

        $band = Band::create([
            'naam' => $request->input('naam'),
            'beschrijving' => $request->input('beschrijving'),
            'biografie' => $request->input('biografie'),
            'genre_id' => $request->input('genre_id'),
            'achtergrondkleur' => $request->input('achtergrondkleur'),
            'tekstkleur' => $request->input('tekstkleur'),
        ]);
        
        auth()->user()->bands()->attach($band->id);
        
        if ($request->hasFile('foto')) {
            $pad = $request->file('foto')->store('fotos', 'public');
            $band->foto = $pad;
            $band->save();
        }

        foreach ($request->input('videos', []) as $url) {
            if (!empty($url)) {
                $band->videos()->create(['url' => $url]);
            }
        }
        return redirect('/dashboard');
    }

}
