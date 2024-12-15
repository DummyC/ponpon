<x-layout>
    <h1 class="title">Edit Login</h1>

    <a href="{{ route('passwords.index') }}" class="block text-blue-500 text-xs mb-2">&larr; Go back</a>

    {{-- Create Post Form --}}
    <div class="card mb-4">

        @if (session('success'))
        <div class="mb-2">
            <x-flashMsg msg="{{ session('success') }}"/>
        </div>
        @endif


        <form action="{{ route('passwords.update', $password) }}" method="post" x-data="formSubmit" @submit.prevent="submit">
            @csrf
            @method('PUT')

            {{-- Login Name --}}
            <div class="mb-4">
                <label for="loginname">Login Name</label>
                <input type="text" name="loginname" value="{{ $password->loginname }}" class="input
                @error('loginname') ring-red-500 @enderror">
                @error('loginname')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Login Email Address --}}
            <div class="mb-4">
                <label for="email">Login Email/Username</label>
                <input type="text" name="email" value="{{ $password->email }}" class="input
                @error('email') ring-red-500 @enderror">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Login Password --}}
            <div class="mb-4">
                <label for="password">Login Password</label>
                <input type="password" name="password" value="{{ $password->password }}" class="input
                @error('password') ring-red-500 @enderror">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Login Note --}}
            <div class="mb-4">
                <label for="note">Note</label>
                <textarea name="note" rows="5" class="input
                @error('note') ring-red-500 @enderror">{{ $password->note }}</textarea>
                @error('note')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button x-ref="btn" class="btn">Update</button>

        </form>
    </div>

</x-layout>
