<x-layout>
    <h1 class="mx-auto max-w-screen-sm title">Reset your password</h1>

    @if (session('status'))
        <x-flashMsg msg="{{ session('status') }}"/>
    @endif

    <div class="mx-auto max-w-screen-sm card">


        <form action="{{ route('password.update') }}" method="post">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

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
                <label for="password">Password</label>
                <input type="password" name="password" class="input
                @error('password') ring-red-500 @enderror">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-8">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="input
                @error('password') ring-red-500 @enderror">
            </div>

            {{-- Submit Button --}}
            <button class="btn">Reset password</button>

        </form>
    </div>
</x-layout>
