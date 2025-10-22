    <x-layout>
    <main class="login">
        <section class="login__section">
            <h1 class="login__title">Login</h1>

            @if($errors->any())
                <div class="login__errors">
                    <ul class="login__errors-list">
                        @foreach($errors->all() as $err)
                            <li class="login__errors-item">{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.authenticate') }}" class="login__form">
                @csrf

                <label for="email" class="login__label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="login__input">

                <label for="password" class="login__label">Password</label>
                <input id="password" type="password" name="password" required class="login__input">

                <button type="submit" class="login__button">Login</button>
            </form>
        </section>
    </main>
</x-layout>
