<?php

namespace App\Http\Controllers;

use App\Models\Watch;
use Illuminate\Http\Request;

class FindController extends Controller {

    public function index(Request $request) {
        $q = trim($request->query('q', ''));
        $min = $request->query('min');
        $max = $request->query('max');

        $watches = Watch::with('images')
            ->when($q, function($query) use ($q) {
                $query->where('name', 'like', "%{$q}%");
                return $query;
            })
            ->when($min !== null && $min !== '', function($query) use ($min) {
                $query->where('price', '>=', (float) $min);
            })
            ->when($max !== null && $max !== '', function($query) use ($max) {
                $query->where('price', '<=', (float) $max);
            })
            ->paginate(20)
            ->withQueryString();

        return view('findwatch', compact('watches'));
    }
}