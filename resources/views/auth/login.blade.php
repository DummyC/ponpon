<x-layout>
    <h1 class="mx-auto max-w-screen-sm title text-center">Welcome Back!</h1>
    <h2 class="mx-auto max-w-screen-sm text-center mb-4">PonPon always have your back!</h2>

    @if (session('status'))
        <x-flashMsg msg="{{ session('status') }}"/>
    @endif

    <div class="mx-auto max-w-screen-sm card">



        <form action="{{ route('login') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
            @csrf

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

            {{-- Remember Checkbox --}}
            <div class="mb-4 flex justify-between items-center">
                <div>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>


                </div>
                <a class="text-sm text-blue-500" href="{{ route('password.request') }}">Forgot your password?</a>
            </div>


            @error('failed')
                    <p class="error mb-4">{{ $message }}</p>
                @enderror

            {{-- Submit Button --}}
            <button x-ref="btn" class="btn">Login</button>

        </form>
    </div>
</x-layout>
