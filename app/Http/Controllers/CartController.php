<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Watch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $items = Cart::with('watch')->where('user_id', Auth::id())->get();
        } else {
            $session = session('cart', []);
            $items = collect($session);
        }

        return view('shoppingcart', compact('items'));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'watch_id' => 'required|exists:watches,id',
            'amount' => 'nullable|integer|min:1',
        ]);

        $userId = Auth::id();
        $watchId = $data['watch_id'];
        $qty = $data['amount'] ?? 1;

        if (Auth::check()) {
            $where = ['user_id' => $userId, 'watch_id' => $watchId];

            // Probeer eerst te incrementen met een where (werkt zonder id PK)
            $updated = DB::table('cartitems')->where($where)->increment('amount', $qty);

            // Als er niets geupdate werd, insert een nieuwe rij met timestamps
            if (! $updated) {
                DB::table('cartitems')->insert(array_merge($where, [
                    'amount' => $qty,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        } 

        return back()->with('success', 'Added to cart');
    }
}