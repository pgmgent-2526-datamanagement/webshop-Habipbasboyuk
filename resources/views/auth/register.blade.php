<x-layout>
    <main class="register">
        <section class="register__container">

            <h1 class="register__title">Register</h1>
    
            @if($errors->any())
                <div class="register__errors">
                    <ul class="register__errors-list">
                        @foreach($errors->all() as $err)
                            <li class="register__errors-item">{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}" class="register__form">
                @csrf
    
                <div class="register__field">
                    <label class="register__label">Name</label>
                    <input class="register__input" type="text" name="name" value="{{ old('name') }}" required>
                </div>
    
                <div class="register__field">
                    <label class="register__label">Email</label>
                    <input class="register__input" type="email" name="email" value="{{ old('email') }}" required>
                </div>
    
                <div class="register__field">
                    <label class="register__label">Password</label>
                    <input class="register__input" type="password" name="password" required>
                </div>
    
                <div class="register__field">
                    <label class="register__label">Confirm Password</label>
                    <input class="register__input" type="password" name="password_confirmation" required>
                </div>
    
                <div class="register__field">
                    <label class="register__label">Adress</label>
                    <input class="register__input" type="text" name="adress" value="{{ old('adress') }}" required>
                </div>

                <div class="register__field">
                    <label class="register__label">Postal Code</label>
                    <input class="register__input" type="text" name="postal_code" value="{{ old('postal_code') }}" required>
                </div>

                <div class="register__field">
                    <label class="register__label">City</label>
                    <input class="register__input" type="text" name="city" value="{{ old('city') }}" required>
                </div>

                <div class="register__field">
                    <label class="register__label">Country</label>
                    <input class="register__input" type="text" name="country" value="{{ old('country') }}" required>
                </div>

                
    
                <button type="submit" class="register__button register__button--primary">Register</button>
            </form>
        </section>
    </main>
</x-layout>