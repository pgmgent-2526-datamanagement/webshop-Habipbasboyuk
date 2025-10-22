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
    
                        @if($src)
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
                    <img id="selectedImage" src="{{ $mainSrc ?? asset('images/no-image.png') }}" alt="{{ $watch->name }}" class="watch__image--large">
                </div>

                <script>
                    (function () {
                        const thumbnails = document.querySelectorAll('.watch__image');
                        const selected = document.getElementById('selectedImage');
                        thumbnails.forEach(thumb => {
                            thumb.addEventListener('click', () => {
                                selected.src = thumb.src;
                                thumbnails.forEach(t => t.classList.remove('is-active'));
                                thumb.classList.add('is-active');
                            });
                        });
                    })();
                </script>
            </section>
            <section class="detail-content-section">
                <div class="detail-content">

                    <h1 class="watch__title">{{ $watch->name }}</h1>
                    <p class="watch__price">€{{ number_format($watch->price ?? 0, 2) }}</p>
                    <p class="watch__description">{{ $watch->description }}</p>
                    <p> {{ $watch->isautomatic ? 'Automatisch' : 'Quartz' }} </p>
                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="watch_id" value="{{ $watch->id }}">
                        <input type="hidden" name="amount" value="1">
                        <button type="submit" class="btn">Add to cart</button>
                    </form>
                </div>
            </article>
            </section>
    </main>
</x-layout>