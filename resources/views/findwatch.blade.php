
<x-layout>
    <main class="find-watch">
        <h1 class="find-watch__title">Find Your Watch</h1>

        <section class="find-watch__intro">
            <div class="find-watch__media">
                <img class="find-watch__image" src="" alt="">
            </div>

            <div class="find-watch__panel">
                <div class="find-watch__filters">
                    <button class="find-watch__filter find-watch__filter--new">New</button>
                    <button class="find-watch__filter find-watch__filter--limited">Limited</button>
                    <button class="find-watch__filter find-watch__filter--classic">Classic</button>
                    <button class="find-watch__filter find-watch__filter--adventure">Adventure</button>
                    <button class="find-watch__filter find-watch__filter--min-price">Min. price</button>
                    <button class="find-watch__filter find-watch__filter--max-price">Max. price</button>
                    <button class="find-watch__filter find-watch__filter--materials">Materials</button>
                    <button class="find-watch__filter find-watch__filter--functions">Functions</button>
                </div>

                <p class="find-watch__or">Or</p>

                <form class="find-watch__search" action="#" method="get">
                    <input class="find-watch__search-input" type="search" name="q" placeholder="Type your watch">
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
        </section>
    </main>
</x-layout>