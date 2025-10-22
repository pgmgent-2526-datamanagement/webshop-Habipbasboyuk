<article {{ $attributes->merge(['class' => 'article-card']) }}>
    @php
        $imgSrc = null;
        $image = null;
        if (isset($watch)) {
            // single image field
            if (!empty($watch->image)) {
                $image = $watch->image;
            }
            // multiple images (collection/array)
            elseif (!empty($watch->images)) {
                $images = $watch->images;
                if (is_object($images) && method_exists($images, 'first')) {
                    $image = $images->first();
                } elseif (is_array($images) || is_iterable($images)) {
                    foreach ($images as $item) { $image = $item; break; }
                }
            }
        }

        if ($image) {
            // If image is a simple string
            if (is_string($image)) {
                $imgSrc = \Illuminate\Support\Str::startsWith($image, ['http://', 'https://'])
                    ? $image
                    : asset('storage/' . ltrim($image, '/'));
            } else {
                // Try common properties on image object/array
                $url = data_get($image, 'url')
                    ?: data_get($image, 'path')
                    ?: data_get($image, 'src')
                    ?: data_get($image, 'filename')
                    ?: data_get($image, 'file');

                if ($url) {
                    $imgSrc = \Illuminate\Support\Str::startsWith($url, ['http://', 'https://'])
                        ? $url
                        : asset('storage/' . ltrim($url, '/'));
                } elseif (is_object($image) && method_exists($image, 'getUrl')) {
                    $imgSrc = $image->getUrl();
                }
            }
        }
    @endphp

    @if ($imgSrc)
        <a href="{{ isset($watch) && !empty($watch->id) ? url('/watches/' . $watch->id) : '#' }}">
            <img class="article__image" src="{{ $imgSrc }}" alt="{{ $title ?? 'Product' }}">
        </a>
    @endif

    <section class="articlecard-section">
        <p class="article__title">{{ $title ?? '' }}</p>
        @if (!empty($excerpt))
            <p class="article__excerpt">{{ $excerpt }}</p>
        @endif
        @if (!empty($price))
            <p class="article__price">EUR{{ $price }}</p>
        @endif

        <form method="POST" class="add-to-cart-form" action="{{ route('cart.add') }}">
            @csrf
            <input type="hidden" name="watch_id" value="{{ $watch->id ?? '' }}">
            <input type="hidden" name="amount" value="1">
            <button type="submit" class="btn add-to-cart__btn">Add to cart</button>
        </form>
    </section>
</article>
