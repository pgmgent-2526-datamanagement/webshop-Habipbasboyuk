<?php

namespace App\Http\Controllers;

use App\Models\Watch;

class FindController extends Controller {

    public function index() {
        $watches = Watch::all();

        return view('findwatch', compact('watches'));
    }
}