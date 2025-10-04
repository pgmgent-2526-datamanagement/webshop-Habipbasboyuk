<?php

namespace App\Http\Controllers;

use App\Models\Watch;

class WatchController extends Controller
{
    public function index()
    {
        $watches = Watch::all();
        
        return view('landing', compact('watches'));
    }
}