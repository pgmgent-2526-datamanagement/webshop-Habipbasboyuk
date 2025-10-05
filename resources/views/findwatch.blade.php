<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Find Watch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('components/header')

    <main class="main__find">
        <h1>Find Your Watch</h1>

        <section>

            <div>
                <img href="">
            </div>

            <div>

                <div>
                    <button>New</button>
                    <button>Limited</button>
                    <button>Classic</button>
                    <button>Adventure</button>
                    <button>Min. price</button>
                    <button>Max.price</button>
                    <button>Materials</button>
                    <button>Functions</button>
                </div>
                <p>Or</p>
                <form>
                        <input type="searchbar" placeholder="Type your watch"></input>

                        <button action="submit">Search ></button>
                </form>
            </div>

        </section>

        <section>

        </section>
    </main>

    @include('components/footer')
</body>
</html>