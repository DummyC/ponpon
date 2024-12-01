<x-layout>
    <h1 class="title">Home</h1>

    @auth
        <h1>Logged In!</h1>
    @endauth

    @guest
        <h1>You're a guest</h1>
    @endguest
</x-layout>
