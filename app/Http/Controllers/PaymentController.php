<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Cart;
use App\Models\Watch;
use App\Mail\OrderThankYouMail;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;

class PaymentController extends Controller
{
    /**
     * Show shipping form prefilled with authenticated user's address.
     */
    public function shipping()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $shipping = [
            'name' => $user->name ?? '',
            'adress' => $user->adress ?? '',
            'postal_code' => $user->postal_code ?? '',
            'city' => $user->city ?? '',
            'country' => $user->country ?? '',
            'phone' => $user->phone ?? '',
        ];

        return view('payment.shipping', compact('shipping'));
    }

    /**
     * Store shipping on the authenticated user and redirect to checkout.
     * No session fallback: persist to user profile.
     */
    public function storeShipping(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'adress' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:30',
        ]);

        $user = Auth::user();
        $user->name = $data['name'];
        $user->adress = $data['adress'] ?? $user->adress;
        $user->postal_code = $data['postal_code'] ?? $user->postal_code;
        $user->city = $data['city'] ?? $user->city;
        $user->country = $data['country'] ?? $user->country;
        $user->phone = $data['phone'] ?? $user->phone;
        $user->save();

        return redirect()->route('checkout');
    }

    /**
     * Show checkout page with totals and user's saved shipping.
     * No session fallback: requires authenticated user.
     */
    public function checkout()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $shipping = [
            'name' => $user->name ?? '',
            'adress' => $user->adress ?? '',
            'postal_code' => $user->postal_code ?? '',
            'city' => $user->city ?? '',
            'country' => $user->country ?? '',
            'phone' => $user->phone ?? '',
        ];

        $total = 0.0;
        $items = Cart::with('watch')->where('user_id', $user->id)->get();
        foreach ($items as $item) {
            if ($item->watch) {
                $qty = $item->amount ?? 1;
                $total += ($item->watch->price * $qty);
            }
        }

        $totalFormatted = number_format($total, 2, ',', '.');
        $totalCents = (int) round($total * 100);

        return view('payment.checkout', compact('total', 'totalFormatted', 'totalCents', 'shipping'));
    }

    /**
     * Create Stripe Checkout session using total calculated from DB carts (authenticated user only).
     */
    public function createPayment(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $totalCents = 0;
        $items = Cart::with('watch')->where('user_id', $user->id)->get();
        foreach ($items as $item) {
            if ($item->watch) {
                $qty = $item->amount ?? 1;
                $totalCents += (int) round($item->watch->price * 100) * $qty;
            }
        }

        if ($totalCents <= 0) {
            return back()->with('error', 'Cart is empty or no valid items.');
        }

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

    /**
     * Success callback: build order from DB, send mail, clear user's cart.
     */
    public function success()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $cartItems = Cart::with('watch')->where('user_id', $user->id)->get();
        $orderItems = [];
        $total = 0.0;

        foreach ($cartItems as $item) {
            if (! $item->watch) {
                continue;
            }
            $qty = $item->amount ?? 1;
            $lineTotal = $item->watch->price * $qty;
            $orderItems[] = [
                'id' => $item->watch->id,
                'name' => $item->watch->name,
                'price' => $item->watch->price,
                'quantity' => $qty,
                'line_total' => $lineTotal,
            ];
            $total += $lineTotal;
        }

        $order = (object) [
            'customer_name' => $user->name ?? '',
            'email' => $user->email ?? null,
            'items' => $orderItems,
            'total' => $total,
        ];

        if (! empty($order->email)) {
            Mail::to($order->email)->send(new OrderThankYouMail($order));
        }

        // clear user's cart (DB)
        Cart::where('user_id', $user->id)->delete();

        return view('payment.success', compact('order'));
    }

    /**
     * Cancel page for payment cancellation.
     */
    public function cancel()
    {
        return view('payment.cancel');
    }
}