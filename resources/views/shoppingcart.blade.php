<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Winkelwagen</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ \Carbon\Carbon::now()->timestamp }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Genos:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    @include('components.header')
    <h1>shoppingcart</h1>
<section class='cart__container'>
    <div class="cart__products">
    @if(auth()->check())
        @if(isset($items) && $items->count())
            @foreach($items as $item)

            <article class="cart__product">
                
                @php
                $filename = $item->watch->image->filename ?? null;
                $src = null;
                if ($filename) {
                    $src = \Illuminate\Support\Str::startsWith($filename, ['http://','https://'])
                    ? $filename
                    : asset('storage/' . ltrim($filename, '/'));
                }
                @endphp

            @if($src)
            <img class="cart__product-image" src="{{ $src }}" alt="{{ $item->watch->name }}">
            @endif
            <div class="cart__product-info">
                <p>{{$item->watch->name}}</p>
                <p>{{$item->watch->description}}</p>
                <p>EUR {{$item->watch->price}}</p>
            </div>

            <section class="cart__product-amount">
                <button class="cart__product-amount-button">-</button>
                <p>{{$item->amount}}</p>
                <button class="cart__product-amount-button">+</button>
                
            </article>
            @endforeach
        @else
            <p>Your cart is empty.</p>
        @endif
    @else
    <div class="cart__not-logged-in">
        <p >Log in to see your cart.</p>
        <a href="{{ route('login.authenticate') }}" class="cart__login-link">Login</a>
    </div>
    @endif
    </div>
    @if(isset($items) && $items->count() && auth()->check())
        <section class="cart__summary">
            <p class="cart__summary-title">Order Summary</p>
            <div class="cart__summary-details">
                <p class="cart__summary-item"> Subtotal: <span>EUR {{ number_format($items->sum(fn($item) => $item->watch->price * $item->amount), 2, ',', '.') }}</span></p>

                <p class="cart__summary-item"> Shipping: <span>EUR 0.00</span></p>
            </div>
            <p class="cart__summary-total">Total: <span>EUR {{ number_format($items->sum(fn($item) => $item->watch->price * $item->amount), 2, ',', '.') }}</span></p>

            <div class="cart__summary-actions">
                <button class="btn btn--checkout">Proceed to Checkout</button>
                <button class="btn btn--continue-shopping">Continue Shopping</button>
            </div>
        </section>
    @endif
</section>
    @include('components.footer')
</body>
</html>