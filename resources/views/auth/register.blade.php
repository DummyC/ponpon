<x-layout>
    <h1 class="mx-auto max-w-screen-sm title text-center">PonPon welcomes you!</h1>
    <h2 class="mx-auto max-w-screen-sm text-center mb-4">Come join us today to protect your digital credentials!</h2>

    <div class="mx-auto max-w-screen-sm card">


        <form action="{{ route('register') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
            @csrf

            {{-- Username --}}
            <div class="mb-4">
                <label for="username">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" class="input
                @error('username') ring-red-500 @enderror">
                @error('username')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email Address --}}
            <div class="mb-4">
                <label for="email">Email Address</label>
                <input type="text" name="email" value="{{ old('email') }}" class="input
                @error('email') ring-red-500 @enderror">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password">Master Password</label>
                <input type="password" name="password" class="input
                @error('password') ring-red-500 @enderror">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-8">
                <label for="password_confirmation">Confirm Master Password</label>
                <input type="password" name="password_confirmation" class="input
                @error('password') ring-red-500 @enderror">
            </div>

            {{-- Submit Button --}}
            <button x-ref="btn" class="btn">Register</button>

        </form>
    </div>
</x-layout>
