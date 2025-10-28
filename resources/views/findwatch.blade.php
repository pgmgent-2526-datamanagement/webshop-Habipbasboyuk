
<x-layout>
    <main class="find-watch">
        <h1 class="find-watch__title">Find Your Watch</h1>

        <section class="find-watch__intro">
            <div class="find-watch__media">
                <img class="find-watch__image" src="" alt="">
            </div>

            <div class="find-watch__panel">
                <form class="find-watch__search" action="{{ route('findwatch') }}" method="get">
                    <input class="find-watch__search-input" type="search" name="q" value="{{ request('q') }}" placeholder="Type your watch">
                    <input class="find-watch__search-input" type="number" name="min" value="{{ request('min') }}" placeholder="Min price" step="0.01" min="0">
                    <input class="find-watch__search-input" type="number" name="max" value="{{ request('max') }}" placeholder="Max price" step="0.01" min="0">
                    <button class="find-watch__search-button" type="submit">Search &gt;</button>
                </form>
            </div>
        </section>

                <section class="find-watch__results">
            @forelse($watches as $watch)
                @php
                    $firstImage = $watch->images->first() ?? ($watch->image ?? null);
                    $filename = $firstImage->filename ?? (is_string($firstImage) ? $firstImage : null);
                    $src = null;

                    if ($filename) {
                        $filename = ltrim($filename, '/');

                        if (\Illuminate\Support\Str::startsWith($filename, ['http://','https://'])) {
                            $src = $filename;
                        } elseif (file_exists(public_path('storage/' . $filename))) {
                            $src = asset('storage/' . $filename);
                        } elseif (file_exists(public_path($filename))) {
                            $src = asset($filename);
                        }
                    }
                @endphp

                <x-article
                    :title="$watch->name"
                    :image="$src"
                    :excerpt="$watch->description"
                    :price="$watch->price"
                    :watch="$watch"
                    :url="route('detailwatch', $watch->id)"
                    class="find-watch__result"
                />
            @empty
                <div class="find-watch__not-found">
                    <h2>Not found</h2>
                    <p>No watches matched your search.</p>
                </div>
            @endforelse
            @if (method_exists($watches, 'links'))
                <div class='find-watch__pagination'>
                    {{ $watches->links('components.pagination') }}
                </div>
                
            @endif
        </section>
    </main>
</x-layout>