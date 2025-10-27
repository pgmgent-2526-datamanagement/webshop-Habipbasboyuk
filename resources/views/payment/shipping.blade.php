<x-layout>
    <main class="shipping">
        <section class="shipping__container">
            <h1>Shipping details</h1>

            @if($errors->any())
                <div class="errors">
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('shipping.store') }}" class="shipping__form">
                @csrf

                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $shipping['name'] ?? '') }}" required>

                <label>Adress</label>
                <input type="text" name="adress" value="{{ old('adress', $shipping['adress'] ?? '') }}">

                <label>Postal code</label>
                <input type="text" name="postal_code" value="{{ old('postal_code', $shipping['postal_code'] ?? '') }}">

                <label>City</label>
                <input type="text" name="city" value="{{ old('city', $shipping['city'] ?? '') }}">

                <label>Country</label>
                <input type="text" name="country" value="{{ old('country', $shipping['country'] ?? '') }}">

                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $shipping['phone'] ?? '') }}">

                <button type="submit" class="btn">Continue to payment</button>
            </form>
        </section>
    </main>
</x-layout>