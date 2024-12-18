<x-layout>

    @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}"/>
    @endif

    <h1 class="mx-auto max-w-screen-sm title">Verify your email</h1>

    <div class="mx-auto max-w-screen-sm card">
        <h1 class="mb-4">Please verify your email through the email PonPon sent you.</h1>

    <p class="mb-2">Didn't get the email?</p>
    <form action="{{ route('verification.send') }}" method="post">
        @csrf

        <button class="btn">Send again</button>
    </form>
    </div>



</x-layout>
