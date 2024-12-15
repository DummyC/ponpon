<x-layout>
    <h1 class="title">Logins</h1>



    <div class="card mb-4">
        @if (session('success'))
        <x-flashMsg msg="{{ session('success') }}" bg="bg-green-500"/>
        @elseif (session('delete'))
            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500"/>
        @endif

        <div class="flex justify-between">
            <a href="{{ route('add') }}" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 my-6">Add Login</a>

            <div class="inline-flex">
                <form class="flex place-items-center gap-1" action="{{ route('passwords.index') }}" method="GET">
                    <input class="input p-2.5" placeholder="Search..." type="text" name="search">
                    <button class="btn p-2.5">Search</button>
                </form>
            </div>



        </div>

        <div>
            <h2 class="font-bold">Total Logins: {{ $passwords->count() }}</h2>
        </div>

        <table class="table-auto w-full mt-4 border-slate-950 text-left [&_:is(th,td):where(:nth-child(4),:nth-child(4))]:text-right">
            <tr>
                <th class="border-b-2 border-slate-400 text-center"><i class="fa-solid fa-globe"></i></th>
                <th class="border-b-2 border-slate-400">Login Name</th>
                <th class="border-b-2 border-slate-400">Note</th>
                <th class="border-b-2 border-slate-400 px-1 py-1">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </th>
            </tr>
            @if($passwords->count() > 0)
            @foreach ($passwords as $password)
            <tr>
                <td class="border-b border-slate-400 text-center"><i class="fa-solid fa-globe"></i></td>
                <td class="border-b border-slate-400">
                    <div>
                        <a href="{{ route('passwords.edit', $password) }}" class="text-blue-500">{{ $password->loginname }}</a>
                    </div>
                    <span class="text-sm">{{ $password->email }}</span>
                </td>
                <td class="border-b border-slate-400">{{ $password->note }}</td>
                <td class="border-b border-slate-400 items-center">

                    <div x-data="{ open:false }">
                        {{-- Dropdown menu button --}}
                    <button @click="open = !open"  type="button" class="px-1 py-1">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>

                    {{-- Dropdown menu --}}
                    <div x-show="open" @click.outside="open = false" class="bg-white shadow-lg absolute rounded-lg right-16 overflow-hidden font-sm">
                        <button @click="open = false" id="ops" class="block w-full text-left hover:bg-slate-100 px-2 py-1 mb-1 pr-8" data-clipboard-text="{{ $password->email }}"><span><i class="fa-regular fa-copy"></i> Copy Username</span></button>
                        <button @click="open = false" id="ops" class="block w-full text-left hover:bg-slate-100 px-2 py-1 mb-1 pr-8" data-clipboard-text="{{ $password->password }}"><span><i class="fa-solid fa-key"></i> Copy Password</span></button>

                        <p>
                            <a href="{{ route('passwords.edit', $password) }}" class="block w-full text-left hover:bg-slate-100 px-2 py-1 mb-1 pr-8"><span><i class="fa-regular fa-pen-to-square"></i> Edit Login</span></a>
                        </p>

                        <form action="{{ route('passwords.destroy', $password) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="block w-full text-left hover:bg-slate-100 px-2 py-1 pr-8 text-red-500"><span><i class="fa-solid fa-trash"></i> Delete Login</span></button>
                        </form>

                    </div>
                    </div>


                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td></td>
                <td>
                    <p class="text-sm text-center">You have no passwords stored.</p>
                </td>
            </tr>
            @endif
        </table>

    </div>

</x-layout>

