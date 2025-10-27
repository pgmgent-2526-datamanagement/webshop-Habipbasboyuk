<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Watch;

class WatchController extends Controller
{
    public function landing() {
        
        $watches = Watch::with('images')->inRandomOrder()->limit(6)->get();
        return view('landing', compact('watches'));
    }

    public function index(Request $request)
    {
            $q = trim($request->query('q', ''));

        $watches = Watch::with('images')
            ->when($q, function($query) use ($q) {
                $query->where(function($qfinder) use ($q) {
                    $qfinder->where('name', 'like', "%{$q}%");
                });
            })
            ->paginate(20)
            ->withQueryString();

        return view('findwatch', compact('watches'));
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