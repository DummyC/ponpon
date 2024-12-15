<x-layout>
    <h1 class="title">Welcome, {{ auth()->user()->username }}</h1>

    {{-- Create Post Form --}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Add Login</h2>

        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}"/>
        @endif


        <form action="{{ route('passwords.store') }}" method="post">
            @csrf

            {{-- Login Name --}}
            <div class="mb-4">
                <label for="loginname">Login Name</label>
                <input type="text" name="loginname" value="{{ old('loginname') }}" class="input
                @error('loginname') ring-red-500 @enderror">
                @error('loginname')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Login Email Address --}}
            <div class="mb-4">
                <label for="email">Login Email/Username</label>
                <input type="text" name="email" value="{{ old('email') }}" class="input
                @error('email') ring-red-500 @enderror">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Login Password --}}
            <div class="mb-4">
                <label for="password">Login Password</label>
                <input type="password" name="password" value="{{ old('password') }}" class="input
                @error('password') ring-red-500 @enderror">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Login Note --}}
            <div class="mb-4">
                <label for="note">Note</label>
                <textarea name="note" rows="5" class="input
                @error('note') ring-red-500 @enderror">{{ old('note') }}</textarea>
                @error('note')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button class="btn">Add</button>

        </form>
    </div>

</x-layout>
