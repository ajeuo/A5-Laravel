<?php

namespace App\Http\Controllers;
use App\Models\Band;
use Illuminate\Http\Request;

class BandController extends Controller
{
    public function index(Request $request) {

        $searchReq = $request->input('search');

        $bands = collect();

        if ($request->filled('search')) {
            //sql 
            $bands = Band::where('naam', 'like', '%' . $searchReq . '%')->get();
        }

        return view('home', ['bands' => $bands]);
    }

    public function show($id) {
        $band = Band::findOrFail($id);
        return view('band', ['band' => $band]);
    }

    public function dashboard() {
        $bands = auth()->user()->bands;
        return view('dashboard', ['bands' => $bands]);
    }
}
