<x-layout>
    <section class='cart__container'>
        <div class="cart__products">
            @if (auth()->check())
                @if (isset($items) && $items->count())
                    @foreach ($items as $item)
                        <article class="cart__product">

                            @php
                                $filename = data_get($item, 'watch.images.0.filename');

                                $src = null;
                                if ($filename) {
                                    $src = \Illuminate\Support\Str::startsWith($filename, ['http://', 'https://'])
                                        ? $filename
                                        : asset('storage/' . ltrim($filename, '/'));
                                }
                            @endphp

                            <img class="cart__product-image" src="{{ $src }}" alt="{{ $item->watch->name }}">
                            <div class="cart__product-info">
                                <p>{{ $item->watch->name }}</p>
                                <p>{{ $item->watch->description }}</p>
                                <p>EUR {{ $item->watch->price }}</p>
                            </div>

                            <section class="cart__product-amount">
                                <form method="POST" action="{{ route('cart.decrease') }}" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="watch_id" value="{{ $item->watch_id }}">
                                    <button type="submit" class="btn">-</button>
                                </form>

                                <span class="cart__product-amount-value">{{ $item->amount ?? 0 }}</span>

                                <form method="POST" action="{{ route('cart.increase') }}" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="watch_id" value="{{ $item->watch_id }}">
                                    <button type="submit" class="btn">+</button>
                                </form>

                        </article>
                    @endforeach
                @else
                    <p class="cart__empty-message">Your cart is empty.</p>
                @endif
            @else
                <div class="cart__not-logged-in">
                    <p>Log in to see your cart.</p>
                    <a href="{{ route('login.authenticate') }}" class="cart__login-link">Login</a>
                </div>
            @endif
        </div>
        @if (isset($items) && $items->count() && auth()->check())
            <section class="cart__summary">
                <p class="cart__summary-title">Order Summary</p>
                <div class="cart__summary-details">
                    <p class="cart__summary-item"> Subtotal: <span>EUR
                            {{ $items->sum(fn($item) => $item->watch->price * $item->amount) }}</span></p>

                    <p class="cart__summary-item"> Shipping: <span>EUR 0.00</span></p>
                </div>
                <p class="cart__summary-total">Total: <span>EUR
                        {{ $items->sum(fn($item) => $item->watch->price * $item->amount) }}</span></p>

                <div class="cart__summary-actions">
                    <button class="btn btn--checkout">Proceed to Checkout</button>
                    <button class="btn btn--continue-shopping">Continue Shopping</button>
                </div>
            </section>
        @endif
    </section>
</x-layout>
