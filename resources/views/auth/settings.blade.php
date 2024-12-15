<x-layout>
    <div class="card mx-auto max-w-screen-sm">
        <div class="flex items-center gap-3 mb-4">
            <img src="{{ asset('user.png') }}" alt="" class="size-20">
            <div>
                <h1>{{ auth()->user()->username }}</h1>
                <h2 class="text-sm text-blue-600">{{ auth()->user()->email }}</h2>
            </div>

        </div>

        <h2 class="title">Change master password</h2>

        @if (session('success'))
        <x-flashMsg msg="{{ session('success') }}"/>
        @endif

        <form action="{{ route('auth.update-password') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
            @csrf

            {{-- Old Password --}}
            <div class="mb-4">
                <label for="password">Current Master Password</label>
                <input type="password" name="old_password" class="input
                @error('old_password') ring-red-500 @enderror">
                @error('old_password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>


            {{-- Password --}}
            <div class="mb-4">
                <label for="password">New Master Password</label>
                <input type="password" name="new_password" class="input
                @error('new_password') ring-red-500 @enderror">
                @error('new_password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-8">
                <label for="password_confirmation">Confirm New Master Password</label>
                <input type="password" name="new_password_confirmation" class="input
                @error('new_password') ring-red-500 @enderror">
            </div>

            @error('failed')
                    <p class="error mb-4">{{ $message }}</p>
                @enderror

            {{-- Submit Button --}}
            <button x-ref="btn" class="btn">Register</button>

        </form>
    </div>

</x-layout>
