
<x-layout>
    <main class='main__checkout'>
    <div class="checkout__shipping {{ empty($shipping) ? 'checkout__shipping--empty' : '' }}">
        @if(!empty($shipping))
            <h2 class="checkout__shipping-title">Shipping details</h2>
            <address class="checkout__shipping-address">
                <p class="checkout__shipping-name">{{ $shipping['name'] ?? '' }}</p>
                <p class="checkout__shipping-line">
                    <span class="checkout__shipping-street">{{ $shipping['adress'] ?? '' }}</span>
                    <span class="checkout__shipping-postal">{{ $shipping['postal_code'] ?? '' }}</span>
                </p>
                <p class="checkout__shipping-location">
                    <span class="checkout__shipping-city">{{ $shipping['city'] ?? '' }}</span>
                    <span class="checkout__shipping-country">{{ $shipping['country'] ?? '' }}</span>
                </p>
            </address>
        @else
            <p class="checkout__shipping-empty">No shipping info.</p>
        @endif
    </div>

        <div class='checkout_section'>
        <h1 class="checkout__title">Checkout</h1>
        <p class="checkout__total">Totaal: €{{ $totalFormatted ?? number_format($total ?? 0, 2, ',', '.') }}</p>

        <form action="{{ route('payment.create') }}" method="POST" class="checkout__form">
            @csrf
            <input type="hidden" name="amount" value="{{ $totalCents ?? ((int)round(($total ?? 0) * 100)) }}" class="checkout__amount">
            <button type="submit" class="checkout__button checkout__button--success">Nu betalen met Stripe 💳</button>
        </form>
    </div>
    </section>
</main>
</x-layout>