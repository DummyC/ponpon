<x-layout>
    <h1 class="mx-auto max-w-screen-sm title">Request a password reset</h1>

    @if (session('status'))
        <x-flashMsg msg="{{ session('status') }}"/>
    @endif

    <div class="mx-auto max-w-screen-sm card">



        <form action="{{ route('password.request') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
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

            @error('failed')
                    <p class="error">{{ $message }}</p>
                @enderror

            {{-- Submit Button --}}
            <button x-ref="btn" class="btn">Request</button>

        </form>
    </div>
</x-layout>
