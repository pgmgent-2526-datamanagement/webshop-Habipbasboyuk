<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Watch;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;

class PaymentController extends Controller
{
    public function checkout()
    {
        $total = 0.0;

        if (Auth::check()) {

            $user = Auth::user();

            $shipping = [
                'name' => $user->name ?? '',
                'adress' => $user->adress ?? '',
                'postal_code' => $user->postal_code ?? '',
                'city' => $user->city ?? '',
                'country' => $user->country ?? '',
                
            ];

            $items = Cart::with('watch')->where('user_id', Auth::id())->get();
            foreach ($items as $item) {
                if ($item->watch) {
                    $total += ($item->watch->price * ($item->amount ?? 1));
                }
            }
        } else {
            $sessionCart = session('cart', []);
            if (! empty($sessionCart)) {
                $watchIds = array_keys($sessionCart);
                $watches = Watch::whereIn('id', $watchIds)->get()->keyBy('id');
                foreach ($sessionCart as $id => $row) {
                    $watch = $watches->get((int) $id);
                    if ($watch) {
                        $qty = $row['amount'] ?? 1;
                        $total += ($watch->price * $qty);
                    }
                }
            }
            $shipping = session('shipping', null);
        }

        $totalFormatted = number_format($total, 2, ',', '.');
        $totalCents = (int) round($total * 100);

        return view('payment.checkout', compact('total', 'totalFormatted', 'totalCents', 'shipping'));
    }

    public function createPayment(Request $request)
    {
        // alleen ingelogde gebruikers mogen betalen
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // Bereken totaal (in centen) uit DB voor ingelogde user
        $totalCents = 0;

        $items = Cart::with('watch')->where('user_id', Auth::id())->get();
        foreach ($items as $item) {
            if ($item->watch) {
                $qty = $item->amount ?? 1;
                $totalCents += (int) round($item->watch->price * 100) * $qty;
            }
        }

        if ($totalCents <= 0) {
            return back()->with('error', 'Cart is empty or no valid items.');
        }

        // Stripe checkout aanmaken met totaalbedrag als één regel
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = CheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Bestelling bij ' . config('app.name'),
                    ],
                    'unit_amount' => $totalCents,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        return view('payment.success');
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}