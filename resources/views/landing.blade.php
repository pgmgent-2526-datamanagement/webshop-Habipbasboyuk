<x-layout>
    <main >

        <section class="landing__section landing__section--intro">
            <p class="landing__intro-text">Unleash <br> Your Style</p>
        </section>

        <section class="landing__section--boosters">
            <div class="landing__image-wrapper parallax">
                <img class="landing__image" src="{{ asset('storage/web/blue_watch_dark_bg.png') }}" alt="Style Boosters">
            </div>
            <div class="boosers__content">
                <h2 class="landing__title">STYLE <br> BOOSTERS</h2>
                <div class="landing__watches">
@foreach ($watches as $watch )
    <div class="landing__watch">
        
            @php
                $filename = $watch->images->first()->filename ?? null;
 
                 if ($filename) {
                     $src = \Illuminate\Support\Str::startsWith($filename, ['http://', 'https://'])
                         ? $filename
                         : asset('storage/' . ltrim($filename, '/'));
                 }
            @endphp
            <img class="landing__watch-image" src="{{ $src }}" alt="{{ $watch->name }}">
        <p class="landing__watch-name">{{ $watch->name }}</p>
        <p class="landing__watch-price">${{ number_format($watch->price, 2) }}</p>
    </div>
@endforeach
                </div>
                <a class="btn" href="">All Watches > </a>
            </div>
        </section>

        <section class="info-collection">
            <div class="info-collection-content">
                <p class="info-collection-label">TIMELESS STYLE</p>
                <h2 class="info-collection-title">A Statement Of Elegance</h2>
                <p class="info-collection-description">A ChronoLux watch is more than a timepiece—it's a symbol of refined taste and sophisticated style. Designed to complement your lifestyle, from boardroom to ballroom.</p>
                <p class="info-collection-description">Experience the perfect fusion of form and function, where every glance at your wrist reminds you of the exceptional craftsmanship you carry.</p>
                <a class="btn" href="">View Collection</a>
            </div>
            <div class="info-collection-image-wrapper">
                <img class="info-collection-image" src="{{ asset('storage/web/making_watch.png') }}" alt="Watch Image">
            </div>
        </section>
    </main>
</x-layout>