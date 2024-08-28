<x-admin-navbar>
    @if(session()->has('success'))
    <p class="px-2 py-3 mb-2 text-xl border rounded border-emerald-500 bg-emerald-200">{{ session('success') }}</p>
    @endif
    <div class="">
        @if($users->isEmpty())
        <h1 class="py-2 text-center">No Other Users Created yet</h1>
        @else
        <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">No</th>
                    {{-- <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Name</th> --}}
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Role</th>
                    <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">Email</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach ($users as $user)
                <tr>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">{{ $loop->iteration }}</td>
                    {{-- <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">{{ $user->name }}</td> --}}
                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                        <p class="text-wrap line-clamp-2">{{ $user->role }}</p></td>
                    <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                        <p class="text-wrap line-clamp-2">{{ $user->email }}</p></td>
                    <td class="flex flex-col justify-center gap-2 px-4 py-2 md:flex-row whitespace-nowrap">
                        <a href="/users/edit/{{ $user->email }}"
                            class="inline-block px-4 py-2 text-xs font-medium text-white rounded bg-cyan-600 hover:bg-cyan-700">
                            Edit
                        </a>
                        <form action="/users/{{ $user->email }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return handleDelete()"
                                class="inline-block px-4 py-2 text-xs font-medium text-white rounded bg-rose-600 hover:bg-rose-700">
                                delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
        @endif
    </div>
    <script>
        const handleDelete = () => {
		        return confirm('Are you want to delete this user?')
		    }
    </script>
</x-admin-navbar>