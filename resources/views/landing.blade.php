<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    @include('components.header')

    <main>

        <section>
            <p>Unleash Your Style</p>
        </section>

        <section>
            <div>
                <img src="{{ asset('images/web/blue_watch_dark_bg.png') }}" alt="Style Boosters">
        </div>
            <h2>STYLE BOOSTERS</h2>
            <div>
                @foreach($watches as $watch)
                    <div>
                        <h3>{{ $watch->name }}</h3>
                        <p>{{ $watch->description }}</p>
                        <p>Price: ${{ $watch->price }}</p>
                    </div>
                @endforeach
            </div>

            <a href="">Shop Now</a>
        </section>

        <section>
            <div>
                <p>TIMELESS STYLE</p>
                <h2>A Statement Of Elegance</h2>
                <p>A ChronoLux watch is more than a timepiece—it's a symbol of refined taste and sophisticated style. Designed to complement your lifestyle, from boardroom to ballroom.</p>
                <p>Experience the perfect fusion of form and function, where every glance at your wrist reminds you of the exceptional craftsmanship you carry.</p>

                <a href="">View Collection</a>
            </div>
            <div>
                <img src="{{ asset('images/web/making_watch.png') }}" alt="Watch Image">
            </div>

            <a href="">Shop Now</a>

    </main>

    @include('components.footer')
</body>
</html>