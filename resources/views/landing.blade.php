<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Genos:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    @include('components.header')

    <main>

        <section class="landing__section landing__section--intro">
            <p class="landing__intro-text">Unleash <br> Your Style</p>
        </section>

        <section class="landing__section--boosters">
            <div class="landing__image-wrapper">
                <img class="landing__image" src="{{ asset('images/web/blue_watch_dark_bg.png') }}" alt="Style Boosters">
            </div>
            <h2 class="landing__title">STYLE <br> BOOSTERS</h2>
            <div class="landing__watches">
                
            </div>
            <a class="btn" href="">All Watches > </a>
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
                <img class="info-collection-image" src="{{ asset('images/web/making_watch.png') }}" alt="Watch Image">
            </div>
            <a class="btn" href="">Shop Now</a>
        </section>

    @include('components.footer')
</body>
</html>