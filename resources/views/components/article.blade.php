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

        <form method="POST" class="add-to-cart-form" action="{{ route('cart.add') }}">
    @csrf
    <input type="hidden" name="watch_id" value="{{ $watch->id }}">
    <input type="hidden" name="amount" value="1">
    <button type="submit" class="btn add-to-cart__btn">Add to cart</button>
</form>
    </section>
</article>