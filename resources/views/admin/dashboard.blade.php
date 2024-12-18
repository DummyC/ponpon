<x-layout>
    <h1 class="title">Users</h1>



    <div class="card mb-4">
        @if (session('success'))
        <x-flashMsg msg="{{ session('success') }}" bg="bg-green-500"/>
        @elseif (session('delete'))
            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500"/>
        @endif

        <div class="flex justify-between">

            <div class="inline-flex">
                <form class="flex place-items-center gap-1" action="{{ route('users.index') }}" method="GET">
                    <input class="input p-2.5" placeholder="Search..." type="text" name="search">
                    <button class="btn p-2.5">Search</button>
                </form>
            </div>



        </div>

        <div>
            <h2 class="font-bold">Total Users: {{ $users->count() }}</h2>
        </div>

        <table class="table-auto w-full mt-4 border-slate-950 text-left [&_:is(th,td):where(:nth-child(5),:nth-child(5))]:text-right">
            <tr>
                <th class="border-b-2 border-slate-400 text-center"><i class="fa-solid fa-user"></i></th>
                <th class="border-b-2 border-slate-400">Email Address</th>
                <th class="border-b-2 border-slate-400">Role</th>
                <th class="border-b-2 border-slate-400">Status</th>
                <th class="border-b-2 border-slate-400 px-1 py-1">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </th>
            </tr>
            @if($users->count() > 0)
            @foreach ($users as $user)
            <tr>
                <td class="border-b border-slate-400 text-center"><i class="fa-solid fa-user"></i></td>
                <td class="border-b border-slate-400">
                    <div>
                        <a href="#" class="text-blue-500">{{ $user->username }}</a>
                    </div>
                    <span class="text-sm">{{ $user->email }}</span>
                </td>
                <td class="border-b border-slate-400">
                    @if ($user->id === 1)
                        Admin
                    @else
                        User
                    @endif
                </td>
                <td class="border-b border-slate-400">
                    @if ($user->email_verified_at !== null)
                        Verified
                    @else
                        Not Verified
                    @endif
                </td>
                <td class="border-b border-slate-400 items-center">

                    <div x-data="{ open:false }">
                        {{-- Dropdown menu button --}}
                    <button @click="open = !open"  type="button" class="px-1 py-1">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>

                    {{-- Dropdown menu --}}
                    <div x-show="open" @click.outside="open = false" class="bg-white shadow-lg absolute rounded-lg right-16 overflow-hidden font-sm">

                        <form action="{{ route('users.destroy', $user) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="block w-full text-left hover:bg-slate-100 px-2 py-1 pr-8 text-red-500"><span><i class="fa-solid fa-trash"></i> Delete User</span></button>
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
