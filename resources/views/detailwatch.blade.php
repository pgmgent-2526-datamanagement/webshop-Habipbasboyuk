<x-layout>
    <main class="watch-show">
        <article class="watch">
            <section class="watch__images">
                <div class="watch__images-all">
                    @forelse($watch->images ?? [] as $image)
                        @php
                            $filename = ltrim($image->filename ?? '', '/');
                            $src = null;

                            if ($filename) {
                                // 1) try storage symlink: public/storage/...
                                if (file_exists(public_path('storage/' . $filename))) {
                                    $src = asset('storage/' . $filename);
                                }
                            }
                        @endphp

                        @if ($src)
                            <img src="{{ $src }}" alt="{{ $watch->name }}" class="watch__image">
                        @endif
                    @empty
                        <p class="watch__no-images">No images available</p>
                    @endforelse
                </div>
                @php
                    $mainSrc = null;
                    foreach ($watch->images ?? [] as $image) {
                        $filename = ltrim($image->filename ?? '', '/');
                        if ($filename && file_exists(public_path('storage/' . $filename))) {
                            $mainSrc = asset('storage/' . $filename);
                            break;
                        }
                    }

                @endphp

                <div class="watch__image-selected">
                    <img id="selectedImage" src="{{ $mainSrc ?? asset('images/no-image.png') }}"
                        alt="{{ $watch->name }}" class="watch__image--large">
                </div>

                <script>
                    (function() {
                        const thumbnails = document.querySelectorAll('.watch__image');
                        const selected = document.getElementById('selectedImage');
                        const firstThumb = thumbnails[0];
                        firstThumb.style.backgroundColor = '#4A5F6A';
                        thumbnails.forEach(thumb => {

                            thumb.addEventListener('click', () => {
                                selected.src = thumb.src;

                                thumbnails.forEach(t => {
                                    t.classList.remove('is-active');
                                    t.style.backgroundColor = '';
                                });

                                thumb.classList.add('is-active');
                                thumb.style.backgroundColor = '#4A5F6A';
                            });
                        });
                    })();
                </script>
            </section>
            <section class="detail-content-section">
                <div class="detail-content">

                    <h1 class="watch__title">{{ $watch->name }}</h1>
                    <p class="watch__price">EUR {{ number_format($watch->price ?? 0, 2) }}</p>
                    <p class="watch__description">{{ $watch->short_description }}</p>
                    <p class="watch__type"> {{ $watch->isautomatic ? 'Automatic' : 'Quartz' }} </p>

                    <div>

                        <ul class="watch__features">
                            <li class="watch__feature">Bestellen en betalen via Unleash</li>
                            <li class="watch__feature">Gratis verzending</li>
                            <li class="watch__feature">2 jaar garantie</li>
                            <li class="watch__feature">14 dagen retourrecht</li>
                            <li class="watch__feature watch__feature--next-day">Voor 23:59 besteld, morgen in huis</li>
                        </ul>

                    </div>
                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="watch_id" value="{{ $watch->id }}">
                        <input type="hidden" name="amount" value="1">
                        <button type="submit" class="btn detail-addcart-btn">Add to cart</button>
                    </form>
                </div>
        </article>
        </section>

        <section class="detail__related">
            <h2 class="detail__related-title">Related Watches</h2>
            <div class="related-watches">
                @foreach($relatedWatches ?? [] as $watchItem)
                <a class="related-watches__link" href="{{ route('detailwatch', $watchItem->id) }}">
                    <article class="related-watches__item">
                        @php
                            $filename = ltrim($watchItem->images->first()->filename ?? '', '/');
                            $src = null;

                            if ($filename) {
                                if (file_exists(public_path('storage/' . $filename))) {
                                    $src = asset('storage/' . $filename);
                                }
                            }
                        @endphp
                        <img src="{{ $src }}" alt="{{ $watchItem->name }}" class="related-watches__image">
                        <div class="related-watches__info">
                            <h3 class="related-watches__title">{{ $watchItem->name }}</h3>
                            <p class="related-watches__price">EUR {{ number_format($watchItem->price ?? 0, 2) }}</p>
                        </div>
                    </article>
                </a>
                @endforeach
            </div>
        </section>

    </main>
</x-layout>
