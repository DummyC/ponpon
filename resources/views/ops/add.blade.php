<x-layout>
    <h1 class="title">Add Login</h1>

    <a href="{{ route('passwords.index') }}" class="block text-blue-500 text-xs mb-2">&larr; Go back</a>

    {{-- Create Post Form --}}
    <div class="card mb-4">

        @if (session('success'))
        <div class="mb-2">
            <x-flashMsg msg="{{ session('success') }}"/>
        </div>
        @endif


        <form action="{{ route('passwords.store') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
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
                <label>
                    <input id="password" type="password" name="password" value="{{ old('password') }}" class="input
                @error('password') ring-red-500 @enderror">
                <span onclick="let a=this.parentElement.children[0];(a.type==='password')?a.setAttribute('type','text'):a.setAttribute('type','password')" style="position: absolute;right: 70px; top: 51%;transform: translateY(-50%);cursor: pointer;"><i class="fa-solid fa-eye"></i></span>
                <span onclick="createPassword()" style="position: absolute;right: 50px; top: 51%;transform: translateY(-50%);cursor: pointer;"><i class="fa-solid fa-arrows-rotate"></i></span>
                <span onclick="copyPassword()" style="position: absolute;right: 90px; top: 51%;transform: translateY(-50%);cursor: pointer;"><i class="fa-solid fa-copy"></i></span>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror

                </label>

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
            <button x-ref="btn" class="btn">Add</button>

        </form>
    </div>

<script>
    const passwordBox = document.getElementById("password");
    const length = 12;

    const upperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const lowerCase = "abcdefghijklmnopqrstuvwxyz";
    const number = "0123456789";
    const symbol = "@#$%^&*()_+~|{}[]<>/-=";

    const allChars = upperCase + lowerCase + number + symbol;

    function createPassword(){
        let password = "";

        password += upperCase[Math.floor(Math.random() * upperCase.length)];
        password += lowerCase[Math.floor(Math.random() * lowerCase.length)];
        password += number[Math.floor(Math.random() * number.length)];
        password += symbol[Math.floor(Math.random() * symbol.length)];

        while(length > password.length){
            password += allChars[Math.floor(Math.random() * allChars.length)];

        }

        passwordBox.value = password;
    }

    function copyPassword() {

        passwordBox.select();

        navigator.clipboard.writeText(passwordBox.value);

    }

</script>

</x-layout>
