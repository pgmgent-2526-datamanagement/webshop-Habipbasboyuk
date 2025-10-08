<article {{ $attributes->merge(['class' => 'article-card']) }}>
    @if($image)
        <a href="{{ $url }}">
            <img src="{{ $image }}" alt="{{ $title }}" class="landing__watch-image">
        </a>
    @endif

    <section class="articlecard-section">

        <p class="article__title">{{ $title }}</p>
    
        @if($excerpt)
            <p class="article__excerpt">{{ $excerpt }}</p>
        @endif
    
        @if($price)
            <p class="article__price">EUR{{ $price }}</p>
        @endif
    </section>
</article>