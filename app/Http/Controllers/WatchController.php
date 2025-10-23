<?php

namespace App\Http\Controllers;

use App\Models\Watch;

class WatchController extends Controller
{
    public function index()
    {
        $watches = Watch::with('images')->get();
        
        return view('landing', compact('watches'));
    }

    public function show($id) {
        $watch = Watch::with('images')->findOrFail($id);

        $relatedWatches = Watch::with('images')
        ->where('id', '!=', $id)
        ->inRandomOrder()
        ->limit(4)
        ->get();

        return view('detailwatch', compact('watch', 'relatedWatches'));
    }
}